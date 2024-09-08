<?php

namespace Database\Factories;

use App\Models\Installation;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'product_list' => $this->faker->words(),
            'gateway_ref' => $this->faker->word(),
            'merchant_ref' => $this->faker->word(),
            'month' => Carbon::now(),
            'status' => $this->faker->randomElement(['UNPAID', 'PAID', 'EXPIRED', 'FAILED']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'installation_id' => Installation::factory(),
        ];
    }
}
