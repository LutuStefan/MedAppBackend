<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserOccupationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        $industries = [
            'Agriculture', 'Construction', 'Education', 'Finance', 'Healthcare',
            'Manufacturing', 'Retail', 'Technology', 'Transportation', 'Utilities'
        ];

        return [
            'user_id' => User::factory(),
            'occupation_id' => Occupation::factory(),
            'education_level_id' => 1,
            'jobTitle' => $this->faker->jobTitle,
            'companyName' => $this->faker->company,
            'industry' => $this->faker->randomElement($industries),
        ];
    }

    public function setUserId(int $userId): UserOccupationsFactory
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId
            ];
        });
    }
}
