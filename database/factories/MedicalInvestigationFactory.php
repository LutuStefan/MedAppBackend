<?php

namespace Database\Factories;

use App\Models\MedicalInvestigation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalInvestigationFactory extends Factory
{
    protected $model = MedicalInvestigation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $possibleInvestigationTypes = [
            'X-ray',
            'Complete Blood Count'
        ];
        $possibleInformation = [
            [
                'image' => 'investigationImages/rxExample.jpeg',
                'symptoms' => $this->faker->randomElements([
                        'Clear, watery nasal discharge that may become thicker and vary in color.',
                        'Mild to moderate pain in the throat, often worsened by swallowing.',
                        'Painful, swollen lymph nodes (glands) in the neck.',
                        'Fever.',
                        'Cough.',
                        'A reflex to clear the throat of mucus or irritants.',
                        'Hoarseness or loss of voice.',
                        'Frequent, uncontrollable sneezing that helps to clear the nasal passages.',
                        'General tiredness and malaise that may accompany or worsen other symptoms.',
                        'A sore throat is a painful, dry, or scratchy feeling in the throat.'
                    ], 5)
            ],
            [
                'results' => $this->faker->randomElements([
                    ['name' => 'Hemoglobin', 'value' => 16.5, 'normalRange' => '12-16', 'unit' => 'g/dL'],
                    ['name' => 'Hematocrit', 'value' => 48, 'normalRange' => '36-46', 'unit' => '%'],
                    ['name' => 'White blood cell count', 'value' => 6.2, 'normalRange' => '4.5-11', 'unit' => 'x10^3/uL'],
                    ['name' => 'Platelet count', 'value' => 350, 'normalRange' => '150-450', 'unit' => 'x10^3/uL'],
                    ['name' => 'Red blood cell count', 'value' => 5.5, 'normalRange' => '4.5-6', 'unit' => 'x10^6/uL'],
                    ['name' => 'Mean corpuscular volume', 'value' => 87, 'normalRange' => '80-100', 'unit' => 'fL'],
                    ['name' => 'Mean corpuscular hemoglobin', 'value' => 30, 'normalRange' => '27-31', 'unit' => 'pg'],
                    ['name' => 'Mean corpuscular hemoglobin concentration', 'value' => 34, 'normalRange' => '32-36', 'unit' => 'g/dL'],
                    ['name' => 'Red cell distribution width', 'value' => 12.5, 'normalRange' => '11.5-14.5', 'unit' => '%'],
                    ['name' => 'Neutrophils', 'value' => 60, 'normalRange' => '40-70', 'unit' => '%'],
                    ['name' => 'Lymphocytes', 'value' => 30, 'normalRange' => '20-40', 'unit' => '%'],
                    ['name' => 'Monocytes', 'value' => 6, 'normalRange' => '2-8', 'unit' => '%'],
                    ['name' => 'Eosinophils', 'value' => 3, 'normalRange' => '1-4', 'unit' => '%'],
                    ['name' => 'Basophils', 'value' => 1, 'normalRange' => '0-1', 'unit' => '%'],
                    ['name' => 'Neutrophils', 'value' => 3.7, 'normalRange' => '1.8-7.7', 'unit' => 'x10^3/uL'],
                    ['name' => 'Lymphocytes', 'value' => 1.8, 'normalRange' => '1-3', 'unit' => 'x10^3/uL'],
                    ['name' => 'Monocytes', 'value' => 0.4, 'normalRange' => '0.2-1', 'unit' => 'x10^3/uL'],
                    ['name' => 'Eosinophils', 'value' => 0.2, 'normalRange' => '0.1-0.4', 'unit' => 'x10^3/uL'],
                    ['name' => 'Basophils', 'value' => 0.1, 'normalRange' => '0-0.2', 'unit' => 'x10^3/uL']
                ], 10)
            ]
        ];
        $investigationType = rand(0, 1);

        return [
            'user_id' => User::factory(),
            'doctor_id' => User::factory(),
            'type' => $possibleInvestigationTypes[$investigationType],
            'date' => now(),
            'interpretation' => $this->faker->sentence,
            'information' => json_encode($possibleInformation[$investigationType]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
