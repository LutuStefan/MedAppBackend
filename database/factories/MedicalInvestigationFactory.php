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
        return [
            'user_id' => User::factory(),
            'doctor_id' => User::factory(),
            'type' => $this->faker->randomElement([
                'X-ray investigation'
            ]),
            'date' => now(),
            'interpretation' => $this->faker->sentence,
            'information' => json_encode([
        'image' => $this->faker->imageUrl(),
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
            ], 5),
        ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
