<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationLevel;

class EducationLevelsTableSeeder extends Seeder
{
    public function run()
    {
        $educationLevels = [
            [
                'name' => 'High School',
                'description' => 'Completion of secondary education',
                'translations' => [
                    ['locale' => 'en', 'field' => 'name', 'value' => 'High School'],
                    ['locale' => 'ro', 'field' => 'name', 'value' => 'Liceu'],
                ]
            ],
            [
                'name' => 'University',
                'description' => 'Advanced academic degree',
                'translations' => [
                    ['locale' => 'en', 'field' => 'name', 'value' => 'University'],
                    ['locale' => 'ro', 'field' => 'name', 'value' => 'Universitate']
                ]
            ],
            [
                'name' => 'Primary School',
                'description' => 'Completion of elementary education',
                'translations' => [
                    ['locale' => 'en', 'field' => 'name', 'value' => 'Primary School'],
                    ['locale' => 'ro', 'field' => 'name', 'value' => 'Școala primară'],
                ]
            ]
        ];

        foreach ($educationLevels as $level) {
            $education = EducationLevel::create([
                'name' => $level['name'],
                'description' => $level['description']
            ]);

            foreach ($level['translations'] as $translation) {
                $education->translations()->create($translation);
            }
        }
    }
}
