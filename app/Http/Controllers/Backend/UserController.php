<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Libraries\ScormApiService;
use App\Libraries\ScormCloud_Php_Sample;
use App\Mail\WelcomeEmail;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\LearnerElearningCourse;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use RusticiSoftware\Cloud\V2 as ScormCloud;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'desc');
        $search = $request->get('search', '');
        $role = $request->get('role', '');

        // Fetch all roles for the dropdown
        $roles = ['Learner', 'Admin', 'Corporate Client', 'Trainer'];

        // Start with a query builder
        $query = User::query();

        // Filter by search term if provided
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by role if selected
        if (!empty($role)) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        // Apply sorting and pagination
        $users = $query->orderBy('id', $sort)->paginate(10);

        return view('backend.user.index', compact('users', 'sort', 'search', 'roles', 'role'));
    }

    // public function search(Request $request)
    // {
    //     $text = $request->input('text');

    //     if (empty($text)) {
    //         $users = User::all();
    //     } else {
    //         $users = User::where('name', 'like', '%' . $text . '%')->get();
    //     }

    //     return view('backend.user.search_rows', compact('users'));
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $roles = Role::all();
        $categories = Category::all();
        $courses = Course::all();

        //        $coursesGeneralEnrolment = Task::where('type', 'GeneralEnrolment')->get();
        //        $coursesCourseWork = Task::where('type', 'CourseWork')->get();
        //        $coursesReminders = Task::where('type', 'Reminders')->get();
        //        $coursesPostCompletion = Task::where('type', 'PostCompletion')->get();

        $sortField = $request->get('sortField', 'start_date_time');
        $sortOrder = $request->get('sortOrder', 'desc');
        $cohorts = Cohort::with('course', 'corporateClient', 'trainer')
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        //$cohorts = Cohort::with('course', 'corporateClient', 'trainer')->paginate(10);
        $clients = User::role('Corporate Client')->get();
        $selectedCourses = [];
        $assignedTasks = [];

        $cohortDates = DB::table('cohorts')
            ->select(DB::raw('YEAR(start_date_time) as year'), DB::raw('MONTH(start_date_time) as month'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return view('backend.user.partials.cohorts_table', compact('cohorts', 'user', 'selectedCourses'));
        }


        return view('backend.user.create', compact('cohortDates', 'user', 'roles', 'categories', 'courses', 'cohorts', 'clients', 'selectedCourses', 'sortField', 'sortOrder', 'assignedTasks'));
    }

    public function filterCohorts(Request $request)
    {
        $categoryId = $request->input('category_id');
        $courseId = $request->input('course_id');
        $filterDate = $request->input('filter_date');

        // Query the cohorts based on filters
        $query = Cohort::with('course', 'corporateClient', 'trainer');

        if ($categoryId) {
            $query->whereHas('course.category', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        if ($filterDate) {
            $dateParts = explode('-', $filterDate);
            $year = $dateParts[0];
            $month = $dateParts[1];
            $query->whereYear('start_date_time', $year)
                ->whereMonth('start_date_time', $month);
        }

        $cohorts = $query->paginate(10);

        // Return the partial view with updated cohorts
        return response()->json([
            'cohorts' => view('backend.user.partials.cohorts_table', compact('cohorts'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'user_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telephone' => 'required',
                'birth_date' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'cohort_ids' => 'array',
                'cohort_ids.*' => 'exists:cohorts,id'
            ]);

            $imageName = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Correct reference to 'image' field
                $uploadedFile = $request->file('image');

                // Create a unique file name
                $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

                // Store the file in the 'public' disk under 'profile_images' directory
                $filePath = $uploadedFile->storeAs('profile_images', $fileName, 'public');

                // Save the full path to store in the database
                $imageName = 'storage/' . $filePath;
            }

            unset($validatedData['user_type']);
            unset($validatedData['cohort_ids']);
            // Generate and assign password
            $password = Str::random(10);
            $validatedData['image'] = $imageName;
            $validatedData['password'] = Hash::make($password);

            if ($request->corporate_client_id) {
                $validatedData['client_id'] = $request->corporate_client_id;
            }

            $user = User::create($validatedData);
            $user->assignRole($request->user_type);
            // If the user is a learner
            if ($request->user_type == 4) {

                // Sync cohorts
                $cohortIds = $request->input('cohort_ids', []);
                $user->cohorts()->sync($cohortIds);

                if (isset($cohortIds)) {
                    foreach ($cohortIds as $cohort_id) {
                        $cohort = Cohort::find($cohort_id);

                        foreach ($cohort->course->licenses as $license) {

                            $courseId = $license->course_id;
                            $course_id = $cohort->course->id;
                            $learner_id = $validatedData['name'];
                            $learnerEmail = $validatedData['email'];
                            $learnerFirstName = $validatedData['name'];
                            $learnerLastName = $validatedData['last_name'];
                            $registration_id = 'reg_' . $courseId . '_' . uniqid();
                            // Usage Example
                            $scormApiService = new ScormApiService();
                            $registrationId = $registration_id;
                            $learner = [
                                'id' => $learner_id,
                                'email' => $learnerEmail,
                                'firstName' => $learnerFirstName,
                                'lastName' => $learnerLastName ?? "",
                            ];

                            // Create the registration
                            //dd($registrationId,$learner,$courseId);
                            $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);

                            // Generate the launch link
                            $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 2592000, 'Message');
                            $launchUrl = $launchLinkResponse['launchLink'];
                            $courseName = $license->name;

                            try {
                                TaskSubmission::create([
                                    'user_id' => $user->id,
                                    'license_id' => $license->id,
                                    'course_id' => $course_id,
                                    'cohort_id' => $cohort->id,
                                    'trainer_id' => $cohort->trainer_id,
                                    'scorm_registration_id' => $registration_id,
                                    'scorm_course_link' => $launchUrl,
                                ]);
                            } catch (\Exception $e) {
                                dd($e->getMessage()); // Dump the error message to debug
                            }
                        }
                    }
                }
            }

            // Send welcome email
            Mail::to($user->email)->send(new WelcomeEmail($user, $password));
            DB::commit(); // Commit the transaction if everything is successful
            return redirect()->route('backend.users.index')->with('success', 'User added successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            // Log the error for debugging purposes
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->route('backend.users.index')->with('error', 'Failed to create user. Please try again. ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $idFormEdit = true;
        $roles = Role::all();
        $categories = Category::all();
        $courses = Course::all();
        $cohorts = Cohort::with('course', 'corporateClient', 'trainer')->paginate(10);
        $clients = User::role('Corporate Client')->get();

        // Retrieve selected e-learning courses using DB query
        $selectedCourses = DB::table('learner_elearning_courses')
            ->where('learner_id', $user->id)
            ->pluck('course_name')
            ->toArray();


        $coursesGeneralEnrolment = Task::where('type', 'GeneralEnrolment')->get();
        $coursesCourseWork = Task::where('type', 'CourseWork')->get();
        $coursesReminders = Task::where('type', 'Reminders')->get();
        $coursesPostCompletion = Task::where('type', 'PostCompletion')->get();


        $cohortDates = DB::table('cohorts')
            ->select(DB::raw('YEAR(start_date_time) as year'), DB::raw('MONTH(start_date_time) as month'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        //$assignedTasks = $user->tasks->pluck('id')->toArray();

        return view('backend.user.edit', compact('cohortDates', 'user', 'roles', 'categories', 'courses', 'cohorts', 'clients', 'idFormEdit', 'selectedCourses', 'coursesGeneralEnrolment', 'coursesCourseWork', 'coursesReminders', 'coursesPostCompletion'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $imageName = $user->image; // Set the default to the current image in the database
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Correct reference to 'image' field
            $uploadedFile = $request->file('image');

            // Create a unique file name
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            // Store the file in the 'public' disk under 'profile_images' directory
            $filePath = $uploadedFile->storeAs('profile_images', $fileName, 'public');

            // Save the full path to store in the database
            $imageName = 'storage/' . $filePath;
        }

        $user->update([
            'name' => $request->name,
            'client_id' => isset($request->corporate_client_id) ? $request->corporate_client_id : null,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'image' => $imageName ?? null,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'company' => $request->company,
            'website' => $request->website,
            'telephone' => $request->telephone
        ]);

        $user->syncRoles($request->user_type);

        if ($request->user_type == 4) { // learner

            // Sync cohorts
            $cohortIds = $request->input('cohort_ids', []);
            $user->cohorts()->sync($cohortIds);

            if (isset($cohortIds)) {


                TaskSubmission::where('user_id', $user->id)->delete();

                foreach ($cohortIds as $cohort_id) {
                    $cohort = Cohort::find($cohort_id);

                    foreach ($cohort->course->licenses as $license) {

                        $courseId = $license->course_id;
                        $course_id = $cohort->course->id;
                        $learner_id = $request->name;
                        $learnerEmail = $request->email;
                        $learnerFirstName = $request->name;
                        $learnerLastName = $request->last_name;
                        $registration_id = 'reg_' . $courseId . '_' . uniqid();
                        // Usage Example
                        $scormApiService = new ScormApiService();
                        $registrationId = $registration_id;
                        $learner = [
                            'id' => $learner_id,
                            'email' => $learnerEmail,
                            'firstName' => $learnerFirstName,
                            'lastName' => $learnerLastName ?? "",
                        ];

                        // Create the registration
                        //dd($registrationId,$learner,$courseId);
                        $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);

                        // Generate the launch link
                        $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 2592000, 'Message');
                        $launchUrl = $launchLinkResponse['launchLink'];
                        $courseName = $license->name;

                        try {
                            TaskSubmission::create([
                                'user_id' => $user->id,
                                'license_id' => $license->id,
                                'course_id' => $course_id,
                                'cohort_id' => $cohort->id,
                                'trainer_id' => $cohort->trainer_id,
                                'scorm_registration_id' => $registration_id,
                                'scorm_course_link' => $launchUrl,
                            ]);
                        } catch (\Exception $e) {
                            dd($e->getMessage()); // Dump the error message to debug
                        }
                    }
                }
            }
        }


        return redirect()->route('backend.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return redirect()->route('backend.users.index')->with('success', 'User deleted successfully');
    }

    public function showChangePasswordForm()
    {
        return view('backend.user.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->password_check = 1;
        $user->save();
        return redirect()->route('backend.learner.dashboard')->with('success', 'Password changed successfully');
    }
}
