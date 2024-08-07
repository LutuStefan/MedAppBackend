<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
            'firstName' => $this->faker->firstName(),
            'lastName' =>$this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => rand(1,3),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'identificationNumber' => '123456789',
            'birthDate' => Carbon::create(1996, 10, 10),
            'gender' => 'male',
            'address' => json_encode([
                'country' => 'Romania',
                'citizenship' => 'Romania',
                'area' => 'Sector 6',
                'region' => 'Bucharest',
                'city' => 'Bucharest',
                'street' => 'Panselutei',
                'street_number' => '3AB',
                'building' => '3',
                'apartment' => 10
            ]),
            'avatar' => '/avatars/defaultUserProfile.webp',
            'avatar_hash' => null,
            'remember_token' => Str::random(10)
        ];
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

    public function setRoleId(int $id)
    {
        return $this->state(function (array $attributes) use ($id) {
            return [
                'role_id' => $id,
            ];
        });
    }
}
