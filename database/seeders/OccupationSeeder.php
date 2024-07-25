<?php

namespace Database\Seeders;

use App\Models\Occupation;
use App\Providers\Faker\TranslatedJobTitleProvider;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $faker->addProvider(new TranslatedJobTitleProvider($faker));

        $jobTitles = [
            ['ro' => 'Inginer', 'en' => 'Engineer'],
            ['ro' => 'Doctor', 'en' => 'Doctor'],
            ['ro' => 'Profesor', 'en' => 'Teacher'],
            ['ro' => 'Contabil', 'en' => 'Accountant'],
            ['ro' => 'Programator', 'en' => 'Programmer'],
            ['ro' => 'Arhitect', 'en' => 'Architect'],
            ['ro' => 'Avocat', 'en' => 'Lawyer'],
            ['ro' => 'Manager', 'en' => 'Manager'],
            ['ro' => 'Consultant', 'en' => 'Consultant'],
            ['ro' => 'Jurnalist', 'en' => 'Journalist']
        ];

        foreach ($jobTitles as $title) {
            // Check if occupation already exists
            $occupation = Occupation::firstOrCreate(
                ['name' => $title['en']],
                ['description' => $faker->sentence]
            );

            // Add translations if the occupation was newly created
            if ($occupation->wasRecentlyCreated) {
                $occupation->translations()->createMany([
                    [
                        'locale' => 'ro',
                        'field' => 'name',
                        'value' => $title['ro'],
                    ],
                    [
                        'locale' => 'en',
                        'field' => 'name',
                        'value' => $title['en'],
                    ]
                ]);
            }
        }
    }
}
