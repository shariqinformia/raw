<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PermissionSeeder::class);

       // $this->call(CategorySeeder::class);
       // $this->call(QualificationSeeder::class);
        $this->call(ElearningLicenceSeeder::class);
      //  $this->call(ModuleSeeder::class);
       // $this->call(VenueSeeder::class);
       // $this->call(CoursesTableSeeder::class);
       // $this->call(CohortSeeder::class);
    }
}
