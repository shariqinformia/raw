<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insert parent categories
        $qualifications = [
            [
                'name' => 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 2 Award for CCTV Operators (Public Space Surveillance) in the Private Security Industry',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Top Up)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 2 Award for Security Officers in the Private Security Industry (Top Up)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 3 Award in First Aid at Work',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 3 Award in Emergency First Aid at Work',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 3 Award in Paediatric First Aid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '﻿Highfield Level 3 Award in Emergency Paediatric First Aid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 1 Award in Health and Safety within a Construction Environment',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 2 Award for Personal License Holders',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Highfield Level 2 Award in the Principles of Fire Safety',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '﻿Highfield Level 1 Award in the Principles of Fire Safety Awareness',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('qualifications')->insert($qualifications);
    }
}
