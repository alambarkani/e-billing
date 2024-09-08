<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'given_id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->name(),
            'identity' => $this->faker->unique()->word(),
            'identity_image_path' => $this->faker->word(),
            'phone' => $this->faker->numerify(),
            'address' => $this->faker->address(),
            'location_image_path' => $this->faker->word(),
            'last_payment' => Carbon::now(),
            'status' => $this->faker->boolean(),
            'due_date' => $this->faker->randomNumber(),
            'paid' => $this->faker->boolean(),
            'in_arrears' => $this->faker->boolean(),
            'acc' => $this->faker->boolean(),
            'product_id' => Product::factory()->create(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
