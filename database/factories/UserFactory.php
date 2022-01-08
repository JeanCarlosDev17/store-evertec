<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt("1234567.17"), // password
            'remember_token' => Str::random(10),
            'role' => 'user',
            'user_state' => 1
        ];
    }
    public function definitionTest()
    {

        $user = new User();
        $user->name = $this->faker->name();
        $user->email = $this->faker->unique()->safeEmail();
        $user->email_verified_at = now();
        $user->password = bcrypt("1234567.17");
        $user->remember_token = Str::random(10);
        $user->role = 'user';
        $user->user_state = 1;
        return $user;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}