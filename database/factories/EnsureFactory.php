<?php

namespace Database\Factories;

use App\Models\Ensure;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnsureFactory extends Factory
{
    protected  $model = Ensure::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company()
        ];
    }

    public function setEnsureName(string $name): EnsureFactory
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name
            ];
        });
    }
}
