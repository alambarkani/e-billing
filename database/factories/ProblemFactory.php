<?php

namespace Database\Factories;

use App\Models\Installation;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProblemFactory extends Factory
{
    protected $model = Problem::class;

    public function definition(): array
    {
        return [
            'problem_subject' => $this->faker->word(),
            'problem_description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'installation_id' => Installation::factory(),
        ];
    }
}
