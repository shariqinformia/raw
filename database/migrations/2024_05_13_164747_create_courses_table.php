<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->string('qualification');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('duration');
            $table->string('certification');
            $table->string('awarding_bodies')->nullable();
            $table->text('exam')->nullable();
            $table->string('delivery_mode');
            $table->string('course_type')->nullable();
//            $table->text('GeneralEnrolment')->nullable();
//            $table->text('CourseWork')->nullable();
//            $table->text('Reminders')->nullable();
//            $table->text('PostCompletion')->nullable();
           // $table->text('licenses')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
