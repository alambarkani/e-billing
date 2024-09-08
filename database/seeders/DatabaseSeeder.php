<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Installation;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Problem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
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

        Admin::create([
            'name' => 'super',
            'authorize' => 'super-admin'
        ]);


        User::create([
            'username' => 'super',
            'email' => 'alambarkani@gmail.com',
            'email_verified_at' => now(),
            'userable_id' => 1,
            'userable_type' => Admin::class,
            'remember_token' => 'XksIEa231sa',
            'password' => bcrypt('123'),
        ]);

//        Notification::create([
//            'type' => 'register',
//            'title' => 'Register (dikirim setiap ada yang daftar)',
//            'message' => 'Terima Kasih sudah daftar silahkan klik tautan ini ebilling.test:8080/login
//                            lalu masuk dengan akun berikut:',
//            'sender' => '6281234460175',
//            'token' => 'AQpRbuwWTjjJTy_mL#b@'
//        ]);
//
//        Notification::create([
//            'type' => 'monthly',
//            'title' => 'Monthly (dikirim setiap bulan)',
//            'message' => 'Terima Kasih sudah daftar silahkan klik tautan ini ebilling.test:8080/login
//                            lalu masuk dengan akun berikut:',
//            'sender' => '6281234460175',
//            'token' => 'AQpRbuwWTjjJTy_mL#b@'
//        ]);

//        Company::create([
//            'company_name' => 'PT. Tape',
//            'company_address' => 'Jl. jalanjalan',
//            'company_phone' => '628233213',
//            'company_email' => 'test@test.com',
//            'company_logo' => 'storage/logos/corp_logo.png',
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
//        ]);

//        Admin::factory()->count(5)->create();
//        Company::factory()->count(1)->create();
//        Customer::factory()->count(10)->create();
//        Notification::factory()->count(1)->create();
//        Product::factory()->count(3)->create();
//        Installation::factory()->count(3)->create();
//        $invoices = Invoice::factory()->count(4)->create();
//        Problem::factory()->count(2)->create();
//        User::factory()->count(30)->create();
//
//        $invoices->each(function ($invoice) use ($products) {
//            $invoice->products()->attach(
//                $products->random(2)->pluck('id')->toArray()
//            );
//        });
    }
}
