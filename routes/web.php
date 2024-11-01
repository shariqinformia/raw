<?php

use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ResetPasswordUserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ImageSlidesController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoSlidesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
})->name('home.index');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::impersonate();

//Route::get('/service/{slug:slug}', [App\Http\Controllers\Frontend\ServiceController::class, 'show'])->name('service.show');



Route::match(['get', 'post'], '/service/{slug:slug}', [App\Http\Controllers\Frontend\ServiceController::class, 'show'])->name('service.show');

Route::match(['get', 'post'],'/video-slides/{slug:slug}', [App\Http\Controllers\Frontend\VideoSlideController::class, 'show'])->name('video_slides.show');


Route::post('leads', [App\Http\Controllers\Frontend\LeadsController::class, 'store'])->name('leads.store');



Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth', 'forcePasswordChange']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('permission:view dashboard');

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



    Route::group(['prefix' => 'image_slides'], function () {
        Route::get('/', [ImageSlidesController::class, 'index'])->name('image_slides.index')->middleware('permission:see service');
        Route::get('/create', [ImageSlidesController::class, 'create'])->name('image_slides.create')->middleware('permission:add service');
        Route::post('/', [ImageSlidesController::class, 'store'])->name('image_slides.store')->middleware('permission:add service');
        Route::get('/{image_slide}/edit', [ImageSlidesController::class, 'edit'])->name('image_slides.edit')->middleware('permission:change service');
        Route::put('/{image_slide}', [ImageSlidesController::class, 'update'])->name('image_slides.update')->middleware('permission:change service');
        Route::delete('/{image_slide}', [ImageSlidesController::class, 'destroy'])->name('image_slides.destroy')->middleware('permission:delete service');
    });

    Route::group(['prefix' => 'video_slides'], function () {
        Route::get('/', [VideoSlidesController::class, 'index'])->name('video_slides.index')->middleware('permission:see service');
        Route::get('/create', [VideoSlidesController::class, 'create'])->name('video_slides.create')->middleware('permission:add service');
        Route::post('/', [VideoSlidesController::class, 'store'])->name('video_slides.store')->middleware('permission:add service');
        Route::get('/{video_slide}/edit', [VideoSlidesController::class, 'edit'])->name('video_slides.edit')->middleware('permission:change service');
        Route::put('/{video_slide}', [VideoSlidesController::class, 'update'])->name('video_slides.update')->middleware('permission:change service');
        Route::delete('/{video_slide}', [VideoSlidesController::class, 'destroy'])->name('video_slides.destroy')->middleware('permission:delete service');
    });

});

Route::get('/backend/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('backend.user.changePassword');
Route::post('/backend/user/change-password', [UserController::class, 'updatePassword'])->name('user.changePassword');

Route::get('clear-cache', function () {
   // Artisan::call('migrate:fresh --seed');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    return back();
})->name('clear-cache');
