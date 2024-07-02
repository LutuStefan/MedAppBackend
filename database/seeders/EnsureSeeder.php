<?php

namespace Database\Seeders;

use App\Models\Ensure;
use Illuminate\Database\Seeder;

class EnsureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Ensure::DEFAULT_ENSURES as $defaultEnsureName) {
            Ensure::factory()->state(['name' => $defaultEnsureName])->create();
        }
        for ($i = 0; $i < 4; $i++) {
            Ensure::factory()->create();
        }
    }
}
