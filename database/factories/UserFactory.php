<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Installation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => Carbon::now(),
            'username' => $this->faker->unique()->word(),
            'userable_id' => function () {
                $model = $this->faker->boolean ? Customer::factory()->create() : Admin::factory()->create();
                return $model->id;
            },
            'userable_type' => function (array $attributes) {
                // Determine user_type based on the model of user_id
                if (Customer::find($attributes['userable_id'])) {
                    return \App\Models\Customer::class; // Use full namespace of the model
                } else if (Admin::find($attributes['userable_id'])) {
                    return \App\Models\Admin::class; // Use full namespace of the model
                }
                return null;
            },
            'password' => bcrypt($this->faker->password()),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
