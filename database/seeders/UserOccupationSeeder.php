<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use App\Models\Occupation;
use App\Models\User;
use App\Models\UserOccupations;
use Illuminate\Database\Seeder;

class UserOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserOccupations::factory()->count(5)->create();
    }
}
