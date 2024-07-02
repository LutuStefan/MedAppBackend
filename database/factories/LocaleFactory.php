<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => 'ro',
            'name' => 'Romanian'
        ];
    }

    public function setLocale(string $code, string $name): LocaleFactory
    {
        return $this->state(function (array $attributes) use ($code, $name) {
            return [
                'code' => $code,
                'name' => $name
            ];
        });
    }
}
