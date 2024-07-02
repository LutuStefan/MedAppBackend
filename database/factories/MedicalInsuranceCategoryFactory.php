<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalInsuranceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Retiree health insurance',
                'Employment Based Health Insurance',
                'Education Health Insurance',
                'Private Health Insurance',
                'Disability Health Insurance'
            ])
        ];
    }

    public function setCategoryName(string $name): MedicalInsuranceCategoryFactory
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name
            ];
        });
    }
}
