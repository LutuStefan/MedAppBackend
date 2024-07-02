<?php

namespace Database\Seeders;

use App\Models\UserInsuranceInformation;
use Illuminate\Database\Seeder;

class UserInsureInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            UserInsuranceInformation::factory()->setInsuranceForUser($i, $i)->create();
        }
    }
}
