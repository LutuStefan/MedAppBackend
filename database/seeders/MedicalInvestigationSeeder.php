<?php

namespace Database\Seeders;

use App\Models\MedicalInvestigation;
use App\Models\User;
use Illuminate\Database\Seeder;

class MedicalInvestigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users who do not have role_id = 2
        $users = User::where('role_id', '!=', 2)->get();
        $doctors = User::where('role_id', 2)->get()->pluck('id')->toArray();

        foreach ($users as $user) {
            // Create 15 medical investigations for each user
            MedicalInvestigation::factory()
                ->count(15)
                ->for($user, 'user')
                ->create([
                    'user_id' => $user->id,
                    'doctor_id' => $doctors[array_rand($doctors)],
                ]);
        }
    }
}
