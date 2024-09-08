<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['register', 'monthly', 'annually', 'other']),
            'title' => $this->faker->word(),
            'message' => $this->faker->word(),
            'sender' => $this->faker->phoneNumber(),
            'schedule' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
