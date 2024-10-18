<?php

namespace Database\Factories;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CohortFactory extends Factory
{
    protected $model = Cohort::class;

    public function definition()
    {
        $trainer = User::role('Trainer')->inRandomOrder()->first();
        $corporateClient = User::role('Corporate_Client')->inRandomOrder()->first();

        return [
            'max_learner' => $this->faker->numberBetween(10, 20),
            'venue_id' => $this->faker->numberBetween(1, 3),
            'trainer_id' => $trainer ? $trainer->id : null,
            'course_id' => $this->faker->numberBetween(1, 3),
            'corporate_client_id' => $corporateClient ? $corporateClient->id : null,
            'start_date_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'end_date_time' => $this->faker->dateTimeBetween('+3 weeks', '+4 weeks'),
            'booking_reference' => $this->faker->unique()->word,
            'user_id' => 1, // You may adjust this based on your logic
        ];
    }
}
