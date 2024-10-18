<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElearningLicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenses = [
            [
                'name' => 'ACT Awareness',
                'registration_id' => 'reg_ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65_66f3f3472813b',
                'course_id' => 'ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65',
                'course_link' => 'https://cloud.scorm.com/api/cloud/registration/launch/234399fc-5f5a-418c-bf25-4a7112f755aa',
            ],
            [
                'name' => 'ACT Security',
                'registration_id' => 'reg_ACTE-LearningSecurityv1.0.3SCORM1.29e3b7612-c825-4cc0-a546-a97b1c6cf5ba_66f3f347d857e',
                'course_id' => 'ACTE-LearningSecurityv1.0.3SCORM1.29e3b7612-c825-4cc0-a546-a97b1c6cf5ba',
                'course_link' => 'https://cloud.scorm.com/api/cloud/registration/launch/e6d858fd-3c7b-4f29-af52-def093b13e27',
            ]
        ];

        // Insert each license into the database
        foreach ($licenses as $license) {
            DB::table('licenses')->insert([
                'name' => $license['name'],
//                'registration_id' => $license['registration_id'],
                'course_id' => $license['course_id'],
//                'course_link' => $license['course_link'],
            ]);
        }

    }
}
