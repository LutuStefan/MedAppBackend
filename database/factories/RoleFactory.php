<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'user'
        ];
    }

    /**
     * @param string $name
     * @return RoleFactory
     */
    public function setRoleName(string $name): RoleFactory
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name
            ];
        });
    }
}
