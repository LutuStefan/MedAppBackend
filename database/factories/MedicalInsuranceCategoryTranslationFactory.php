<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalInsuranceCategoryTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medical_insurance_category_id' => $this->faker->numberBetween(1, 10),
            'locale_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word
        ];
    }

    public function setTranslationForCategory(string $medicalInsuranceCategoryId, int $localeId, string $name)
    {
        $medicalInsuranceCategories = [
            1 => 'Retiree health insurance',
            2 => 'Employment Based Health Insurance',
            3 => 'Education Health Insurance',
            4 => 'Private Health Insurance',
            5 => 'Disability Health Insurance'
        ];

        return $this->state(
            [
                'medical_insurance_category_id' => array_search($medicalInsuranceCategoryId, $medicalInsuranceCategories),
                'locale_id' => $localeId,
                'name' => $name
            ]
        );
    }
}
