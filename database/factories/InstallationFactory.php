<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Installation;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InstallationFactory extends Factory
{
    protected $model = Installation::class;

    public function definition(): array
    {
        return [
            'given_id' => $this->faker->unique()->randomNumber(),
            'last_payment' => Carbon::now(),
            'installation_address' => $this->faker->address(),
            'status' => $this->faker->boolean(),
            'due_date' => $this->faker->randomNumber(),
            'installation_address_image_path' => $this->faker->word(),
            'paid' => $this->faker->boolean(),
            'in_arrears' => $this->faker->boolean(),
            'acc' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'customer_id' => Customer::factory()->create(),
            'product_id' => Product::factory()->create(),
        ];
    }
}
