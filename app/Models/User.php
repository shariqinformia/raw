<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes,Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function learners()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function cohorts()
    {
        //return $this->belongsToMany(Cohort::class, 'cohort_user', 'user_id', 'cohort_id');

        return $this->belongsToMany(Cohort::class, 'cohort_user')
            ->withPivot('status', 'comments')
            ->withTimestamps();
    }

    public function trainerCohorts()
    {
        return $this->hasMany(Cohort::class, 'trainer_id');
    }


    public function elearningCourses()
    {
        return $this->hasMany(LearnerElearningCourse::class, 'learner_id');
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Cohort::class, 'trainer_id', 'id', 'id', 'course_id');
    }

    public function submittedTasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('status', 'comments')->withTimestamps();
    }


    public function cohortTasks()
    {
        return $this->belongsToMany(Task::class, 'cohort_task_user')
            ->withPivot('cohort_id', 'status', 'comments')
            ->withTimestamps();
    }


    public function profilePhotos()
    {
        return $this->hasMany(ProfilePhoto::class);
    }

    public function profilePhoto()
    {
        return $this->hasOne(ProfilePhoto::class);
    }

    public function documentUpload()
    {
        return $this->hasOne(DocumentUpload::class);
    }

    public function applicationForm()
    {
        return $this->hasOne(ApplicationForm::class,'learner_id');
    }

    public function approvedOrInProgressTasks()
    {
        return $this->tasks()->wherePivotIn('status', ['Approved', 'In Progress']);
    }

    public function bookletTasks()
    {
        return $this->tasks()->whereIn('name', ['DS Distance Learning Booklet', 'CCTV Distance Learning Booklet','DS Top-Up Textbook', 'SG Top-Up Textbook']);
    }

    // Messages the user has sent
    public function receivedMessages() {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function sentMessages() {
        return $this->hasMany(Message::class, 'sender_id');
    }


}
