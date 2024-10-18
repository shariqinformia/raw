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
        return view('backend.dashboard.index');
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
