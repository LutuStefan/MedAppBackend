<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MedicalInsuranceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            'Retiree health insurance',
            'Employment Based Health Insurance',
            'Education Health Insurance',
            'Private Health Insurance',
            'Disability Health Insurance'
        ] as $category) {
            \App\Models\MedicalInsuranceCategory::factory()->state(['name' => $category])->create();
        }
    }
}
