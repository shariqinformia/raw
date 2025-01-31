<?php

use App\Http\Controllers\Backend\ApplicationFormController;
use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\AwardingBodyController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\CohortController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DocumentUploadController;
use App\Http\Controllers\Backend\LeaveController;
use App\Http\Controllers\Backend\LicenceController;
use App\Http\Controllers\Backend\FormSubmissionController;
use App\Http\Controllers\Backend\LearnerDashboardController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProfilePhotoController;
use App\Http\Controllers\Backend\QualificationController;
use App\Http\Controllers\Backend\ResetPasswordUserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ScormController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\TrainerDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VenueController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('home.index');

Route::get('/email-test', function () {
    $to_name = 'Recipient Name';
    $to_email = 'shariq@yopmail.com'; // Replace with the actual recipient email address

    $data = [
        'name' => "Test User",
        'body' => "This is a test email sent from the Laravel server."
    ];

    Mail::raw($data['body'], function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
            ->subject('Laravel Test Email');
        $message->from('your-email@example.com', 'Your Name');
    });

    return 'Test email sent successfully!';
})->name('email.test');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::impersonate();

Route::get('/regions', function () {
    return getRegions();
});

Route::get('/cities/{region}', function ($region) {
    return getCities($region);
});

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth', 'forcePasswordChange']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('permission:view dashboard');
    Route::get('/learner-dashboard', [LearnerDashboardController::class, 'learnerDashboard'])->name('learner.dashboard')->middleware('permission:view learner dashboard');

    Route::post('/edit-form-request/{id}', [DashboardController::class, 'editFormApplicationRequest'])->name('edit_form_request.dashboard')->middleware('permission:add learner dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/{id}', [ProfileController::class, 'updateGeneralInformation'])->name('profile.update.information');
    Route::put('/profile/update/password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:see roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:add roles');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:add roles');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:change roles');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:change roles');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:look at permissions');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:add permissions');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:add permissions');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:change permissions');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:change permissions');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete permissions');
    });

    Route::group(['prefix' => 'assignpermission'], function () {
        Route::get('/', [AssignPermissionController::class, 'index'])->name('assignpermission.index')->middleware('permission:see assign permissions');
        Route::get('/{role}/edit', [AssignPermissionController::class, 'editRolePermission'])->name('assignpermission.edit')->middleware('permission:change assign permissions');
        Route::post('/updaterolepermission', [AssignPermissionController::class, 'updateRolePermission'])->name('assignpermission.update')->middleware('permission:change assign permissions');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:see user');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:add user');
        Route::get('/filterCohorts', [UserController::class, 'filterCohorts'])->name('users.filterCohorts');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('permission:add user');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:change user');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:change user');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete user');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:see user');

        Route::put('/users/{user}/resetpassword', [ResetPasswordUserController::class, 'resetPassword'])->name('users.reset.password')->middleware('permission:change user');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index')->middleware('permission:see settings');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information')->middleware('permission:change settings');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo')->middleware('permission:change settings');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image')->middleware('permission:change settings');
    });


    Route::group(['prefix' => 'leaves'], function () {
        Route::get('/index', [LeaveController::class, 'index'])->name('leaves.index')->middleware('permission:see leave');
        Route::get('/create', [LeaveController::class, 'create'])->name('leaves.create')->middleware('permission:add leave');
        Route::post('/store', [LeaveController::class, 'store'])->name('leaves.store')->middleware('permission:add leave');
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit')->middleware('permission:change leave');
        Route::put('/{leave}', [LeaveController::class, 'update'])->name('leaves.update')->middleware('permission:change leave');
        Route::delete('/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy')->middleware('permission:delete leave');
    });


    Route::group(['prefix' => 'qualifications'], function () {
        Route::get('/index', [QualificationController::class, 'index'])->name('qualifications.index')->middleware('permission:see qualification');
        Route::get('/create', [QualificationController::class, 'create'])->name('qualifications.create')->middleware('permission:add qualification');
        Route::post('/store', [QualificationController::class, 'store'])->name('qualifications.store')->middleware('permission:add qualification');
        Route::get('/{qualification}/edit', [QualificationController::class, 'edit'])->name('qualifications.edit')->middleware('permission:change qualification');
        Route::put('/{qualification}', [QualificationController::class, 'update'])->name('qualifications.update')->middleware('permission:change qualification');
        Route::delete('/{qualification}', [QualificationController::class, 'destroy'])->name('qualifications.destroy')->middleware('permission:delete qualification');
    });

    Route::group(['prefix' => 'exams'], function () {
        Route::get('/index', [ExamController::class, 'index'])->name('exams.index')->middleware('permission:see exam');
        Route::get('/create', [ExamController::class, 'create'])->name('exams.create')->middleware('permission:add exam');
        Route::post('/store', [ExamController::class, 'store'])->name('exams.store')->middleware('permission:add exam');
        Route::get('/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit')->middleware('permission:change exam');
        Route::put('/{exam}', [ExamController::class, 'update'])->name('exams.update')->middleware('permission:change exam');
        Route::delete('/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy')->middleware('permission:delete exam');
    });

    Route::group(['prefix' => 'sub-categories'], function () {
        Route::get('/index', [SubCategoryController::class, 'index'])->name('sub-categories.index')->middleware('permission:see subcategory');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('sub-categories.create')->middleware('permission:add subcategory');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-categories.store')->middleware('permission:add subcategory');
        Route::get('/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit')->middleware('permission:change subcategory');
        Route::put('/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update')->middleware('permission:change subcategory');
        Route::delete('/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy')->middleware('permission:delete subcategory');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index')->middleware('permission:see settings');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information')->middleware('permission:change settings');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo')->middleware('permission:change settings');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image')->middleware('permission:change settings');
    });

    Route::group(['prefix' => 'venues'], function () {
        Route::get('/index', [VenueController::class, 'index'])->name('venues.index')->middleware('permission:see venue');
        Route::get('/create', [VenueController::class, 'create'])->name('venues.create')->middleware('permission:add venue');
        Route::post('/store', [VenueController::class, 'store'])->name('venues.store')->middleware('permission:add venue');
        Route::get('/{venue}/edit', [VenueController::class, 'edit'])->name('venues.edit')->middleware('permission:change venue');
        Route::put('/{venue}', [VenueController::class, 'update'])->name('venues.update')->middleware('permission:change venue');
        Route::delete('/{venue}', [VenueController::class, 'destroy'])->name('venues.destroy')->middleware('permission:delete venue');
    });

    Route::group(['prefix' => 'awarding_bodies'], function () {
        Route::get('/index', [AwardingBodyController::class, 'index'])->name('awarding_bodies.index')->middleware('permission:see awarding_bodies');
        Route::get('/create', [AwardingBodyController::class, 'create'])->name('awarding_bodies.create')->middleware('permission:add awarding_bodies');
        Route::post('/store', [AwardingBodyController::class, 'store'])->name('awarding_bodies.store')->middleware('permission:add awarding_bodies');
        Route::get('/{awardingBody}/edit', [AwardingBodyController::class, 'edit'])->name('awarding_bodies.edit')->middleware('permission:change awarding_bodies');
        Route::put('/{awardingBody}', [AwardingBodyController::class, 'update'])->name('awarding_bodies.update')->middleware('permission:change awarding_bodies');
        Route::delete('/{awardingBody}', [AwardingBodyController::class, 'destroy'])->name('awarding_bodies.destroy')->middleware('permission:delete awarding_bodies');
    });

    Route::group(['prefix' => 'elearning_licences'], function () {
        Route::get('/index', [LicenceController::class, 'index'])->name('elearning_licences.index')->middleware('permission:see elearning_licences');
        Route::get('/create', [LicenceController::class, 'create'])->name('elearning_licences.create')->middleware('permission:add elearning_licences');
        Route::post('/store', [LicenceController::class, 'store'])->name('elearning_licences.store')->middleware('permission:add elearning_licences');
        Route::get('/{elearningLicence}/edit', [LicenceController::class, 'edit'])->name('elearning_licences.edit')->middleware('permission:change elearning_licences');
        Route::put('/{elearningLicence}', [LicenceController::class, 'update'])->name('elearning_licences.update')->middleware('permission:change elearning_licences');
        Route::delete('/{elearningLicence}', [LicenceController::class, 'destroy'])->name('elearning_licences.destroy')->middleware('permission:delete elearning_licences');
    });

    Route::group(['prefix' => 'cohorts'], function () {
        Route::get('/index', [CohortController::class, 'index'])->name('cohorts.index')->middleware('permission:see cohorts');
        Route::get('/create', [CohortController::class, 'create'])->name('cohorts.create')->middleware('permission:add cohorts');
        Route::post('/store', [CohortController::class, 'store'])->name('cohorts.store')->middleware('permission:add cohorts');
        Route::get('/{cohort}/edit', [CohortController::class, 'edit'])->name('cohorts.edit')->middleware('permission:change cohorts');
        Route::put('/{cohort}', [CohortController::class, 'update'])->name('cohorts.update')->middleware('permission:change cohorts');
        Route::delete('/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy')->middleware('permission:delete cohorts');
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/index', [CourseController::class, 'index'])->name('courses.index')->middleware('permission:see course');
        // Route::get('/search', [CourseController::class, 'search'])->name('courses.search')->middleware('permission:see course');
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create')->middleware('permission:add course');
        Route::post('/store', [CourseController::class, 'store'])->name('courses.store')->middleware('permission:add course');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit')->middleware('permission:change course');
        Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware('permission:change course');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:delete course');
        Route::get('/get-subcategories/{category}', [CourseController::class, 'getSubcategories'])->name('courses.getSubcategories')->middleware('permission:add course');
        Route::get('/by-delivery-mode/{deliveryMode}', [CourseController::class, 'getByDeliveryMode'])->name('courses.byDeliveryMode');
    });

    Route::group(['prefix' => 'application-forms'], function () {
        Route::get('/index', [ApplicationFormController::class, 'index'])->name('application-forms.index')->middleware('permission:see application-forms');
        Route::get('/create', [ApplicationFormController::class, 'create'])->name('application-forms.create')->middleware('permission:add application-forms');
        Route::post('/store', [ApplicationFormController::class, 'store'])->name('application-forms.store')->middleware('permission:add application-forms');
        Route::get('/{application_form}/edit', [ApplicationFormController::class, 'edit'])->name('application-forms.edit')->middleware('permission:change application-forms');
        Route::put('/{application_form}', [ApplicationFormController::class, 'update'])->name('application-forms.update')->middleware('permission:change application-forms');
        Route::delete('/{application_form}', [ApplicationFormController::class, 'destroy'])->name('application-forms.destroy')->middleware('permission:delete application-forms');
        Route::post('/preview', [ApplicationFormController::class, 'preview'])->name('application-forms.preview')->middleware('permission:add application-forms');
        Route::post('/update-preview/{id}', [ApplicationFormController::class, 'updatePreview'])->name('application-forms.update-preview')->middleware('permission:edit application-forms');
        // Route::get('/application/pdf/{id}', [ApplicationFormController::class, 'generatePdf'])->name('application.pdf');


        Route::get('/approve/{id}', [ApplicationFormController::class, 'approve'])->name('application-forms.approve');
        Route::post('/reject/{id}', [ApplicationFormController::class, 'reject'])->name('application-forms.reject');

    });

    Route::group(['prefix' => 'profile-photo'], function () {
        Route::get('/index', [ProfilePhotoController::class, 'index'])->name('profile-photo.index')->middleware('permission:see profile photo');
        Route::get('/create', [ProfilePhotoController::class, 'create'])->name('profile-photo.create')->middleware('permission:add profile photo');
        Route::post('/store', [ProfilePhotoController::class, 'store'])->name('profile-photo.store')->middleware('permission:add profile photo');

        Route::get('/{profile_photo}/edit', [ProfilePhotoController::class, 'edit'])->name('profile-photo.edit')->middleware('permission:change profile photo');
        Route::put('/{profile_photo}', [ProfilePhotoController::class, 'update'])->name('profile-photo.update')->middleware('permission:change profile photo');

        Route::post('/upload', [ProfilePhotoController::class, 'upload'])->name('profile-photo.upload')->middleware('permission:add profile photo');

        Route::get('/approve/{id}', [ProfilePhotoController::class, 'approve'])->name('profile.photo.approve');
        Route::post('/reject/{id}', [ProfilePhotoController::class, 'reject'])->name('profile.photo.reject');

    });

    Route::group(['prefix' => 'document-uploads'], function () {
        Route::get('/index', [DocumentUploadController::class, 'index'])->name('document-uploads.index')->middleware('permission:see document uploads');
        Route::get('/create', [DocumentUploadController::class, 'create'])->name('document-uploads.create')->middleware('permission:add document uploads');
        Route::post('/store', [DocumentUploadController::class, 'store'])->name('document-uploads.store')->middleware('permission:add document uploads');

        Route::get('/{documentUpload}/edit', [DocumentUploadController::class, 'edit'])->name('document-uploads.edit')->middleware('permission:change document uploads');
        Route::put('/{documentUpload}', [DocumentUploadController::class, 'update'])->name('document-uploads.update')->middleware('permission:change document uploads');

        Route::get('/approve/{id}', [DocumentUploadController::class, 'approve'])->name('document-uploads.approve');
        Route::post('/reject/{id}', [DocumentUploadController::class, 'reject'])->name('document-uploads.reject');


    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/fetch-notifications', [NotificationController::class, 'fetch'])->name('notifications.fetch');
        Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    });


    Route::group(['prefix' => 'tasks'], function () {
        Route::post('/task/submission', [TaskController::class, 'taskSubmission'])->name('task.submission');
        Route::post('/task/preview', [TaskController::class, 'taskFormPreview'])->name('task.preview');
        //Route::get('/task/{id}', [TaskController::class, 'show'])->name('tasks.show');

        Route::get('/task/{id}/{course_id}/{cohort_id}/{trainer_id}', [TaskController::class, 'show'])->name('tasks.show');

        Route::get('/task/{id}/display', [TaskController::class, 'display'])->name('tasks.display');

        Route::post('/task/save-progress', [TaskController::class, 'saveProgress'])->name('tasks.save-progress');


    });

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/index', [MessageController::class, 'index'])->name('messages.index')->middleware('permission:see messages');
        Route::get('/create', [MessageController::class, 'create'])->name('messages.create')->middleware('permission:add messages');
        Route::post('/store', [MessageController::class, 'store'])->name('messages.store')->middleware('permission:add messages');
        Route::get('/sent', [MessageController::class, 'sent'])->name('messages.sent');
        Route::post('reply/{message}', [MessageController::class, 'reply'])->name('messages.reply');
        Route::get('/view/{id}', [MessageController::class, 'viewMessage'])->name('messages.view');
    });

    Route::get('/forms', [FormSubmissionController::class, 'index'])->name('form.index');
    Route::post('/forms/submit', [FormSubmissionController::class, 'submit'])->name('form.submit');
    Route::get('/password/change', [DashboardController::class, 'showChangeForm'])->name('password.change');

//    Route::group(['prefix' => 'cctv_activity_sheet'], function () {
//        Route::get('/cctv_activity_sheet', [LearnerDashboardController::class, 'cctvActivitySheet'])->name('cctv_activity_sheet.index')->middleware('permission:see cctv_activity_sheet');;
//    });


    Route::get('/flipbook/view/{task}', [LearnerDashboardController::class, 'viewFlipbook'])->name('flipbook.view');

    Route::get('/learner/task/submit/{task}', [LearnerDashboardController::class, 'showTaskSubmissionForm'])
        ->name('learner.task.submit');


    Route::post('/learner/task/submit/{task}', [LearnerDashboardController::class, 'submitTask'])
        ->name('learner.task.submit.post');


    Route::get('learner/taskResponse/{submission}', [LearnerDashboardController::class, 'learnerViewTaskSubmission'])->name('view.task.submission');


    // Trainer Dashboard
    Route::get('/trainer-dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard')->middleware('permission:view trainer dashboard');
    Route::get('/trainer-my-courses', [TrainerDashboardController::class, 'trainerMyCourses'])->name('trainer.my.courses')->middleware('permission:view trainer courses');
    Route::get('/trainer-my-learners', [TrainerDashboardController::class, 'trainerMyLearners'])->name('trainer.my.learners')->middleware('permission:view trainer learners');
    Route::get('/trainer-my-tasks', [TrainerDashboardController::class, 'trainerMyTasks'])->name('trainer.my.tasks')->middleware('permission:view trainer tasks');
    Route::get('review-mark/{user_id}/{task_id}', [TrainerDashboardController::class, 'reviewMark'])->name('review.mark');

    Route::get('/trainer/filter-learners', [TrainerDashboardController::class, 'trainerMyLearners'])->name('trainer.filterLearners');
    //Route::get('trainer/learner/{cohort}/{learner}', [TrainerDashboardController::class, 'showLearnerDetails'])->name('trainer.learner.details');
    Route::get('/trainer/submission/{user_id}/{task_id}/{cohort_id}', [TrainerDashboardController::class, 'viewTaskSubmission'])->name('trainer.viewSubmission');

    Route::post('trainer/bulk-update', [TrainerDashboardController::class, 'bulkUpdate'])->name('trainer.bulkUpdate');

    Route::post('trainer/taskResponse/{submission}', [TrainerDashboardController::class, 'trainerTaskResponse'])->name('task.response');


    // web.php
    Route::post('/upload-lesson-plan', [TrainerDashboardController::class, 'uploadLessonPlan'])->name('upload.lesson.plan');
    Route::post('/invoice/upload', [TrainerDashboardController::class, 'uploadInvoice'])->name('invoice.upload');

    // Client Dashboard
    Route::get('/client-dashboard', [ClientController::class, 'index'])->name('client.dashboard')->middleware('permission:view client dashboard');


    // Search for users CRD

    // Route::get('/user/search', [UserController::class, 'search'])->name('users.search')->middleware('permission:see user');
});

Route::get('/backend/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('backend.user.changePassword');
Route::post('/backend/user/change-password', [UserController::class, 'updatePassword'])->name('user.changePassword');

Route::get('/scorm', [ScormController::class, 'main']);


Route::get('clear-cache', function () {
   // Artisan::call('migrate:fresh --seed');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    return back();
})->name('clear-cache');
