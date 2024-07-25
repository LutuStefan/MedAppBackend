<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationLevelFactory extends Factory
{
    protected $model = EducationLevel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'High School', 'Bachelor\'s Degree', 'Master\'s Degree', 'Doctorate Degree'
            ]),
            'description' => $this->faker->sentence
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (EducationLevel $educationLevel) {
            // Attach English translation
            $educationLevel->translations()->create([
                'locale' => 'en',
                'field' => 'name',
                'value' => $educationLevel->name
            ]);

            // Attach Romanian translation, example using a simple translation logic
            $roName = [
                'High School' => 'Liceu',
                'Bachelor\'s Degree' => 'Diplomă de Licență',
                'Master\'s Degree' => 'Diplomă de Master',
                'Doctorate Degree' => 'Diplomă de Doctorat'
            ][$educationLevel->name] ?? 'Nivel Educațional';

            $educationLevel->translations()->create([
                'locale' => 'ro',
                'field' => 'name',
                'value' => $roName
            ]);
        });
    }
}
