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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $roles = Role::all();
        $sortField = $request->get('sortField', 'start_date_time');
        $sortOrder = $request->get('sortOrder', 'desc');
        $selectedCourses = [];
        $assignedTasks = [];

        return view('backend.user.create', compact( 'user', 'roles',  'sortField', 'sortOrder', 'assignedTasks'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            // Validate input data
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($request->password);

            // Create the user
            $user = User::create($validatedData);

            // Optionally, assign a role
            $user->assignRole(2);  // Assuming role ID for user is 2

            // Send welcome email
            Mail::to($user->email)->send(new WelcomeEmail($user,$request->password));

            return redirect()->route('backend.users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
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

        return view('backend.user.edit', compact( 'user', 'roles', 'idFormEdit'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Excluding current user ID
            'telephone' => 'required|string|max:20',
            'gender' => 'required|in:male,female', // Make sure gender is either male or female
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Optional password change
        ]);


        // Update the user record with the validated data
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender, // Added gender field
            'address' => $request->address,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Only update password if provided
        ]);

         // Redirect back with a success message
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
