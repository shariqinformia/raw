<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert parent categories
        $parentCategories = [
            [
                'name' => 'SIA Security',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'First Aid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Construction',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Fire Safety',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];






        DB::table('categories')->insert($parentCategories);

        // Retrieve parent category IDs
//        $firstAidId = DB::table('categories')->where('name', 'First Aid')->value('id');
//        $healthsafetyId = DB::table('categories')->where('name', 'Health and Safety')->value('id');
//        $securityId = DB::table('categories')->where('name', 'Security')->value('id');
//        $teachingId = DB::table('categories')->where('name', 'Teaching & Academics')->value('id');




        // Insert categories
//        $subCategories = [
//            [
//                'name' => 'Emergency First Aid at Work',
//                'cat_id' => $firstAidId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'First Aid at Work',
//                'cat_id' => $firstAidId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Paediatric First Aid',
//                'cat_id' => $firstAidId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Mental Health First Aid',
//                'cat_id' => $firstAidId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Fire Safety',
//                'cat_id' => $healthsafetyId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Asbestos Awareness',
//                'cat_id' => $healthsafetyId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Manual Handling',
//                'cat_id' => $healthsafetyId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Health and Safety in the Workplace',
//                'cat_id' => $healthsafetyId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'CITB Site Safety Plus',
//                'cat_id' => $healthsafetyId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Door Supervisor',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Top up for Door Supervisors',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Security Guard',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Top up for Security Guards',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'CCTV Operator',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Crowd Safety',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Close Protection',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Top up for Close Protection',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'SIA Trainers',
//                'cat_id' => $securityId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Physical Intervention',
//                'cat_id' => $teachingId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Education Training',
//                'cat_id' => $teachingId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'AET',
//                'cat_id' => $teachingId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'IQA Training',
//                'cat_id' => $teachingId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Assessment Training',
//                'cat_id' => $teachingId,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//        ];
//
//        DB::table('sub_categories')->insert($subCategories);


    }
}
