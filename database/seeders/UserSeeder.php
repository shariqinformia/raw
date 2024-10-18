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
    {$saveImage = null;
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone_number' => '1111 111 1111',
            'telephone' => '1111 111 1111',
            'address' => '',
            'password_check' => 1,
            'image' => $saveImage
        ]);
        $role = Role::findById(1);
        $user->assignRole($role->name);
    }
}
