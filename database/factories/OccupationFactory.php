<?php

namespace Database\Factories;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\Faker\TranslatedJobTitleProvider;

class OccupationFactory extends Factory
{
    protected $model = Occupation::class;

    public function definition()
    {
        $faker = $this->withFaker();
        $faker->addProvider(new TranslatedJobTitleProvider($faker));

        $jobTitleEn = $faker->jobTitle('en');
        $jobTitleRo = $faker->jobTitle('ro');

        return [
            'name' => $jobTitleEn, // This is the name that will be stored in the database.
            'description' => $faker->sentence,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Occupation $occupation) {
            $occupation->translations()->createMany([
                [
                    'locale' => 'ro',
                    'field' => 'name',
                    'value' => $occupation->name, // Assuming you want to translate the name stored in 'name'
                ],
                [
                    'locale' => 'en',
                    'field' => 'name',
                    'value' => $occupation->name,
                ],
            ]);
        });
    }
}
