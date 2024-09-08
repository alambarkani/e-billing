<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->name(),
            'company_address' => $this->faker->address(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_email' => $this->faker->unique()->safeEmail(),
            'company_logo' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
