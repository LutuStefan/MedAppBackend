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
            'medical_insurance_number' => $this->faker->numberBetween(1000000000, 9999999999),
            'doctor_id' => null
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

    public function setFamilyDr(int $drId): UserInsuranceInformationFactory
    {
        return $this->state(function (array $attributes) use ($drId) {
            return [
                'doctor_id' => $drId
            ];
        });
    }
}
