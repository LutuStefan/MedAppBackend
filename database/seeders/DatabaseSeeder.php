<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Role table seeder */
        Role::factory()->state(['name' => Role::USER_ROLE_NAME])->create();
        Role::factory()->state(['name' => Role::DOCTOR_ROLE_NAME])->create();
        Role::factory()->state(['name' => Role::ADMIN_ROLE_NAME])->create();

        /** Create users and attach them roles */
        User::factory()->state(
            ['role_id' => 1]
        )->create();
        User::factory()->state(
            ['role_id' => 2]
        )->create();
        User::factory()->state(
            ['role_id' => 3]
        )->create();

        //run the rest of the seeders:
        $this->call([
            EnsureSeeder::class,
            MedicalInsuranceCategorySeeder::class,
            LocaleSeeder::class,
            UserInsureInformationSeeder::class,
            MedicalInsuranceCategoryTranslationsSeeder::class,
        ]);
    }
}
