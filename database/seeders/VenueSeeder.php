<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $venues = [
            [
                'code' => '1',
                'venue_name' => 'Central Training Centre',
                'address' => '123 Main St, Cityville',
                'city' => 'Cityville',
                'region' => 'Central Region',
                'post_code' => 'CV12 4AB',
                'primary_contact_number' => '0123 456 789',
                'telephone_number' => '0123 456 789',
                'email' => 'central@trainingcentre.com',
                'parking' => 'Available',
                'access_instructions' => 'Enter through the main gate.'
            ],
            [
                'code' => '2',
                'venue_name' => 'Northside Learning Hub',
                'address' => '456 North St, Townsville',
                'city' => 'Townsville',
                'region' => 'Northern Region',
                'post_code' => 'NT34 5CD',
                'primary_contact_number' => '0123 456 790',
                'telephone_number' => '0123 456 790',
                'email' => 'northside@learninghub.com',
                'parking' => 'Street parking only',
                'access_instructions' => 'Access via side entrance.'
            ],
            [
                'code' => '3',
                'venue_name' => 'West End Education Centre',
                'address' => '789 West St, Villagetown',
                'city' => 'Villagetown',
                'region' => 'Western Region',
                'post_code' => 'WT56 7EF',
                'primary_contact_number' => '0123 456 791',
                'telephone_number' => '0123 456 791',
                'email' => 'westend@educationcentre.com',
                'parking' => 'Available',
                'access_instructions' => 'Ring the bell at the front gate.'
            ]
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}
