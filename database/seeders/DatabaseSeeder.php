<?php

namespace Database\Seeders;

use App\Models\InternetPackage;
use App\Models\User;
use Faker\Factory;
use Faker\Provider\ar_EG\Internet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'super',
            'account' => 'super',
            'password' => '123',
            'role' => 'super_admin',
        ]);

        InternetPackage::create([
            'name' => 'basic',
            'price' => 100000
        ]);
    }
}
