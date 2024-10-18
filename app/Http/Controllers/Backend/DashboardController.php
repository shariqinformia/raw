<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\LearnerElearningCourse;
use App\Models\License;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usersByRoleCount = Role::with('users')->get();

        $user_count = User::count();
        $courses = Course::with(['category', 'subcategory'])
            ->whereHas('category', function ($query) {
                $query->whereColumn('id', 'courses.category_id');
            })->paginate(4);

        // Count Learners
        $learner_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Learner');
        })->count();

        // Count Admins
        $admin_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Admin');
        })->count();

        // Count Trainers
        $trainer_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Trainer');
        })->count();

        // Count Corporate Client
        $clients = User::whereHas('roles', function($q) {
            $q->where('name', 'Corporate Client');
        })->limit(5)->get();

        $trainers = User::whereHas('roles', function($q) {
            $q->where('name', 'Trainer');
        })->with(['trainerCohorts'])->paginate(5);


        $cohorts = Cohort::with('course')  // Load the related course
        ->withCount('users')           // Count the learners in the cohort
        ->limit(5)
            ->get();

        $courses_count = Course::count();

        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        $readCount = auth()->user()->receivedMessages()->where('is_read', 1)->count();

        $notifications = Auth::user()->notifications()->paginate(5);

        $total_license = License::all()->count();
        //dd($license);

        if ($request->ajax()) {
            return view('backend.dashboard.pagination.pagination', compact('courses'))->render();
        }
        return view('backend.dashboard.index', compact('total_license','clients','cohorts','trainers','learner_count','admin_count','trainer_count', 'courses_count', 'courses', 'usersByRoleCount','unreadCount','readCount','notifications'));
    }



    public function editFormApplicationRequest(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->is_request_application_form == 1) {
            return response()->json(['success' => false, 'message' => 'Form request already made.']);
        }

        $user->is_request_application_form = 1;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Form request updated successfully.']);
    }

}
