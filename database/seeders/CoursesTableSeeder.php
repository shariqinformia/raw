<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Introduction to Programming',
                'category_id' => 1,
                'qualification' => 'Certificate of Completion',
                'description' => 'An introductory course on programming fundamentals.',
                'price' => 299.99,
                'duration' => '3 days',
                'certification' => 'Yes',
                'module' => 'Module 1: Basics, Module 2: Control Structures, Module 3: Functions',
                'delivery_mode' => 'ClassroomBased',
                'course_type' => 'OpenCourse',
                'user_id' => 1
            ],
            [
                'name' => 'Advanced Data Science',
                'category_id' => 2,
                'qualification' => 'Professional Certificate',
                'description' => 'An advanced course on data science techniques and tools.',
                'price' => 499.99,
                'duration' => '5 days',
                'certification' => 'Yes',
                'module' => 'Module 1: Data Analysis, Module 2: Machine Learning, Module 3: Data Visualization',
                'delivery_mode' => 'Elearning',
                'course_type' => 'ClosedCourse',
                'user_id' => 2
            ],
            [
                'name' => 'Project Management Basics',
                'category_id' => 3,
                'qualification' => 'Certificate of Completion',
                'description' => 'A basic course on project management principles and practices.',
                'price' => 199.99,
                'duration' => '2 days',
                'certification' => 'Yes',
                'module' => 'Module 1: Introduction, Module 2: Planning, Module 3: Execution',
                'delivery_mode' => 'BlendedLearning',
                'course_type' => 'OpenCourse',
                'user_id' => 1
            ],
            // Add more courses as needed
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
