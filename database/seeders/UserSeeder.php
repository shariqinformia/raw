<?php

namespace Database\Seeders;

use App\Libraries\ScormCloud_Php_Sample;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Avatar;
use Spatie\Permission\Models\Role;
use RusticiSoftware\Cloud\V2 as ScormCloud;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = new Avatar();
        $image = time() . ".png";
        $avatar->create('Admin')->save(storage_path('app/public/profile_images/' . $image));
        $saveImage = "profile_images/" . $image;
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'web@deans-group.co.uk',
            'password' => Hash::make('password'),
            'phone_number' => '0121 630 2115',
            'telephone' => '+44 12 1630 2115',
            'address' => '',
            'password_check' => 1,
            'image' => $saveImage
        ]);
        $role = Role::findById(1);
        $user->assignRole($role->name);


        // Create a faker instance
    //    $faker = Faker::create();

        // Find the Learner role once
   //     $role = Role::findByName('Learner');

        // Loop to generate 10,000 fake users
//        for ($i = 0; $i < 27; $i++) {
//            $user = User::create([
//                'name' => $faker->firstName,
//                'last_name' => $faker->lastName,
//                'email' => $faker->unique()->safeEmail,
//                'password' => Hash::make('password'),
//                'password_check' => 1,
//                'telephone' => $faker->phoneNumber,
//            ]);
//
//            // Assign the 'Learner' role to the user
//            $user->assignRole($role->name);
//        }

//        $Learner_client_Data = [
//            ['name' => 'Shariq', 'last_name' => 'Ali', 'email' => 'shariq@yopmail.com'],
//            ['name' => 'abdul', 'last_name' => 'hasan', 'email' => 'abdul@yopmail.com'],
//            ['name' => 'kim', 'last_name' => 'paul', 'email' => 'kim@yopmail.com']
//        ];
//        foreach ($Learner_client_Data as $Learner) {
//            $user = User::create([
//                'name' => $Learner['name'],
//                'email' => $Learner['email'],
//                'last_name' => $Learner['last_name'],
//                'password' => Hash::make('password'),
//                'password_check' => 1,
//                'telephone' => '+44 11 1111 1111'
//            ]);
//            $role = Role::findByName('Learner');
//            $user->assignRole($role->name);
//        }

//        $Learner_client_Data = [
//            ['name' => 'ameer', 'last_name' => 'riaz', 'email' => 'ameer@yopmail.com'],
//            ['name' => 'abdul', 'last_name' => 'hasan', 'email' => 'abdul@yopmail.com'],
//            ['name' => 'kim', 'last_name' => 'paul', 'email' => 'kim@yopmail.com']
//        ];
//        foreach ($Learner_client_Data as $Learner) {
//            $user = User::create([
//                'name' => $Learner['name'],
//                'email' => $Learner['email'],
//                'last_name' => $Learner['last_name'],
//                'password' => Hash::make('password'),
//                'password_check' => 1,
//                'telephone' => '+44 11 1111 1111'
//            ]);
//            $role = Role::findByName('Learner');
//            $user->assignRole($role->name);
//            $tasks = DB::table('tasks')->get();
//            $tasksWithCodes = [];
//            foreach ($tasks as $task) {
//                $tasksWithCodes[$task->id] = [
//                    'task_code' => $task->task_code, // Replace with actual task code logic
//                    'status' => 'Not Submitted', // Default status or any logic to set status
//                    'comments' => null, // Default comments or any logic to set comments
//                ];
//            }
//            $user->tasks()->attach($tasksWithCodes);
//
//            $userCohortAssignments = [
//                2 => [1], // User 2 assigned to Cohort 1
//                3 => [2], // User 3 assigned to Cohort 2
//                4 => [3]  // User 4 assigned to Cohort 3
//            ];
//
//            foreach ($userCohortAssignments as $userId => $cohortIds) {
//                // Find the user by ID
//                $user = User::find($userId);
//
//                if ($user) {
//                    // Attach the cohorts to the user
//                    $user->cohorts()->sync($cohortIds);
//                }
//            }
//        }

        /* TRAINER */


        $trainersData = [
            ['name' => 'Rizwan', 'last_name' => 'Din', 'email' => 'rizwan@yopmail.com']
        ];

        // Iterate over each trainer data and create the user
        foreach ($trainersData as $trainerData) {

            // Create the user with the trainer data
            $user = User::create([
                'name' => $trainerData['name'],
                'last_name' => $trainerData['last_name'],
                'email' => $trainerData['email'],
                'password' => Hash::make('password'),
                'password_check' => 1,
                'telephone' => '0121 630 2115', // You may adjust this if needed
                'address' => '', // You may adjust this if needed
            ]);

            // Assign the "Trainer" role to the user
            $role = Role::findByName('Trainer');
            $user->assignRole($role->name);
        }

//
//            $config = new ScormCloud\Configuration();
//            $config->setUsername(env('APP_ID'));
//            $config->setPassword(env('SECRET_KEY'));
//            ScormCloud\Configuration::setDefaultConfiguration($config);
//            $sc = new ScormCloud_Php_Sample();
//            $elearning_courses = [
//                'ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65' => 'ACT Awareness',
//                'ACTE-LearningSecurityv1.0.3SCORM1.29e3b7612-c825-4cc0-a546-a97b1c6cf5ba' => 'ACT Security'
//            ];
//            if (is_array($elearning_courses)) {
//                foreach ($elearning_courses as $courseId => $courseName) {
//                    $learner_id = $user->name;
//                    $learnerEmail = $user->email;
//                    $learnerFirstName = $user->name;
//                    $learnerLastName = $user->last_name;
//                    $registration_id = 'reg_' . $courseId . '_' . uniqid();
//                    $response = $sc->createRegistration($courseId, $learner_id, $learnerEmail, $learnerFirstName, $learnerLastName, $registration_id);
//                    $launchLink = $sc->buildLaunchLink($registration_id);
//                    if (is_string($courseName)) {
//                        $user->elearningCourses()->create([
//                            'course_id' => $courseId,
//                            'registration_id' => $registration_id,
//                            'course_name' => $courseName,
//                            'course_link' => $launchLink,
//                        ]);
//                    }
//                }
//            }

       // }

        /* TRAINER */

        // Define an array of trainer data
//        $trainersData = [
//            ['name' => 'John doe', 'email' => 'johndoe@example.com'],
//            ['name' => 'Jane Smith', 'email' => 'janesmith@example.com'],
//            ['name' => 'Peter Kevin', 'email' => 'peterkevin@example.com'],
//            // Add more trainers as needed
//        ];
//
//        // Iterate over each trainer data and create the user
//        foreach ($trainersData as $trainerData) {
//
//            // Create the user with the trainer data
//            $user = User::create([
//                'name' => $trainerData['name'],
//                'email' => $trainerData['email'],
//                'password' => Hash::make('password'),
//                'password_check' => 1,
//                'phone_number' => '0121 630 2115', // You may adjust this if needed
//                'address' => '', // You may adjust this if needed
//            ]);
//
//            // Assign the "Trainer" role to the user
//            $role = Role::findByName('Trainer');
//            $user->assignRole($role->name);
//        }

        /* Corporate Client */

//        $corporate_client_Data = [
//            ['name' => 'Simon Paul', 'email' => 'simonpaul@example.com'],
//            ['name' => 'Kerry Pollard', 'email' => 'kerrypollard@example.com'],
//            ['name' => 'Salt Jim', 'email' => 'saltjim@example.com'],
//            // Add more trainers as needed
//        ];
//
//        // Iterate over each trainer data and create the user
//        foreach ($corporate_client_Data as $corporaterData) {
//
//            // Create the user with the trainer data
//            $users = User::create([
//                'name' => $corporaterData['name'],
//                'email' => $corporaterData['email'],
//                'password' => Hash::make('password'),
//                'password_check' => 1,
//                'phone_number' => '0121 630 2115', // You may adjust this if needed
//                'address' => '', // You may adjust this if needed
//            ]);
//
//            // Assign the "Trainer" role to the user
//            $role = Role::findByName('Corporate_Client');
//            $users->assignRole($role->name);
//        }


    }
}
