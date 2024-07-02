<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MedicalInsuranceCategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryTranslationRo = [
            'Retiree health insurance' => 'Asigurare de sănătate pentru pensionari',
            'Employment Based Health Insurance' => 'Asigurare de sănătate bazată pe angajare',
            'Education Health Insurance' => 'Asigurare de sănătate pentru educație',
            'Private Health Insurance' => 'Asigurare de sănătate privată',
            'Disability Health Insurance' => 'Asigurare de sănătate pentru dizabilități'
        ];

        $categoryTranslationEn = [
            'Retiree health insurance' => 'Retiree health insurance',
            'Employment Based Health Insurance' => 'Employment Based Health Insurance',
            'Education Health Insurance' => 'Education Health Insurance',
            'Private Health Insurance' => 'Private Health Insurance',
            'Disability Health Insurance' => 'Disability Health Insurance'
        ];

        foreach ($categoryTranslationRo as $category => $translation) {
            \App\Models\MedicalInsuranceCategoryTranslation::factory()->setTranslationForCategory(
                $category,
                1,
                $translation
            )->create();
        }

        foreach ($categoryTranslationEn as $category => $translation) {
            \App\Models\MedicalInsuranceCategoryTranslation::factory()->setTranslationForCategory(
                $category,
                2,
                $translation
            )->create();
        }
    }
}
