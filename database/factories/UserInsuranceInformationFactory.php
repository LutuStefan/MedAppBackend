<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserInsuranceInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->numberBetween(1, 10),
            'ensure_id' => $this->faker->numberBetween(1, 10),
            'insurance_type' => $this->faker->randomElement(['mandatory', 'optional']),
            'medical_insurance_category_id' => rand(1, 5),
        ];
    }

    public function setInsuranceForUser(int $userId, int $ensureId): UserInsuranceInformationFactory
    {
        return $this->state(function (array $attributes) use ($userId, $ensureId) {
            return [
                'user_id' => $userId,
                'ensure_id' => $ensureId
            ];
        });
    }
}
