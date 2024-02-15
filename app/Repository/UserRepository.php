<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function insertUser($userInformation): int
    {
        return DB::table('users')
            ->insertGetId($userInformation);
    }
}
