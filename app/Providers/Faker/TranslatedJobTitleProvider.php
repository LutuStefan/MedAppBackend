<?php

namespace App\Providers\Faker;

use Faker\Provider\Base;

class TranslatedJobTitleProvider extends Base
{
    protected static $jobTitles = [
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

    public static function jobTitle($locale = 'en')
    {
        $jobTitle = static::randomElement(static::$jobTitles);
        return $jobTitle[$locale] ?? $jobTitle['en'];
    }
}
