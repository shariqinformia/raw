<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'view dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** Role */
            [
                'name' => 'see roles',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add roles',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change roles',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** Permission */
            [
                'name' => 'look at permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** Assing permission */
            [
                'name' => 'see assign permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change assign permissions',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** User */
            [
                'name' => 'see user',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add user',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change user',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** Settings */
            [
                'name' => 'see settings',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change settings',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** Category */
            [
                'name' => 'see category',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add category',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change category',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete category',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** qualification */
            [
                'name' => 'see qualification',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add qualification',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change qualification',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete qualification',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /** course */
            [
                'name' => 'see course',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add course',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change course',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete course',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** cohorts */

            [
                'name' => 'see cohorts',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add cohorts',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change cohorts',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete cohorts',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Venue */
            [
                'name' => 'see venue',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add venue',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change venue',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete venue',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** AwardingBodies */
            [
                'name' => 'see awarding_bodies',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add awarding_bodies',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change awarding_bodies',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete awarding_bodies',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Elearning Licences */
            [
                'name' => 'see elearning_licences',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add elearning_licences',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change elearning_licences',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete elearning_licences',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


            /** Learner Dashboard */

            [
                'name' => 'view learner dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add learner dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Application Form */

            [
                'name' => 'see application-forms',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add application-forms',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change application-forms',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delete application-forms',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** profile photo */

            [
                'name' => 'see profile photo',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add profile photo',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change profile photo',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


            /** Document Uploads */

            [
                'name' => 'see document uploads',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add document uploads',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'change document uploads',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Trainer Learner Tasks */

//            [
//                'name' => 'see cctv_activity_sheet',
//                'guard_name' => 'web',
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],


            /** Trainer Dashboard */

            [
                'name' => 'view trainer dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'view trainer courses',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'view trainer learners',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'view trainer tasks',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Messages */

            [
                'name' => 'see messages',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add messages',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /** Client Dashboard */

            [
                'name' => 'view client dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 2
            ],
//             [
//                 'permission_id' => 1,
//                 'role_id' => 3
//             ],
//             [
//                 'permission_id' => 1,
//                 'role_id' => 5
//             ],
            [
                'permission_id' => 46,
                'role_id' => 4
            ],
            [
                'permission_id' => 48,
                'role_id' => 4
            ],
            [
                'permission_id' => 49,
                'role_id' => 4
            ],
            [
                'permission_id' => 50,
                'role_id' => 4
            ],
            [
                'permission_id' => 51,
                'role_id' => 4
            ],
            [
                'permission_id' => 52,
                'role_id' => 4
            ],
            [
                'permission_id' => 53,
                'role_id' => 4
            ],
            [
                'permission_id' => 54,
                'role_id' => 4
            ],
            [
                'permission_id' => 55,
                'role_id' => 4
            ],
            [
                'permission_id' => 56,
                'role_id' => 4
            ],
            [
                'permission_id' => 57,
                'role_id' => 4
            ],
            [
                'permission_id' => 58,  // see trainer dashboard
                'role_id' => 3
            ],
            [
                'permission_id' => 59,  // see trainer courses
                'role_id' => 3
            ],
            [
                'permission_id' => 60,  // see trainer learners
                'role_id' => 3
            ],
            [
                'permission_id' => 61,  // see trainer tasks
                'role_id' => 3
            ],
            [
                'permission_id' => 62,  // see messages
                'role_id' => 3  // trainer
            ],
            [
                'permission_id' => 63,  // add messages
                'role_id' => 3    // trainer
            ],
            [
                'permission_id' => 62,  // see messages
                'role_id' => 4  // Learner
            ],
            [
                'permission_id' => 63,  // add messages
                'role_id' => 4    // Learner
            ],
            [
                'permission_id' => 64,  // view client dashboard
                'role_id' => 5    // Client
            ],
            [
                'permission_id' => 62,  // view client dashboard
                'role_id' => 5    // Client
            ],
            [
                'permission_id' => 63,  // view client dashboard
                'role_id' => 5    // Client
            ]
        ]);

    }
}
