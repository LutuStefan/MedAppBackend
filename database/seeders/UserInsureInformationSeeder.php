<?php

namespace Database\Seeders;

use App\Models\UserInsuranceInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInsureInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dr = DB::table('users')->where('role_id', 2)->get('id')->first();
        for ($i = 1; $i < 4; $i++) {
            UserInsuranceInformation::factory()->setInsuranceForUser($i, $i)->setFamilyDr($dr->id)->create();
        }
    }
}
