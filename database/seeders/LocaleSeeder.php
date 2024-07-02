<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localesNames = [
            'ro' => 'Romanian',
            'en' => 'English'
        ];

        foreach ($localesNames as $code => $name) {
            \App\Models\Locale::factory()->setLocale($code, $name)->create();
        }
    }
}
