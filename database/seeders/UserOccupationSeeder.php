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
        for ($i = 1; $i <=3; $i++) {
            UserOccupations::factory()->create([
                'user_id' => $i,
                'occupation_id' => Occupation::factory()->create()->id,
                'education_level_id' => EducationLevel::factory()->create()->id,
            ]);
        }
        UserOccupations::factory()->count(5)->create();
    }
}
