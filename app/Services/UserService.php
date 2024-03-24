<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UserService
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $userInformation): array
    {
        $user = User::create($userInformation);

        $token = $user->createToken('restaurantManager', ['client'])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logIn(array $fields)
    {
        //Check email
        $user = User::where('email', $fields['email'])->first();
        //Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw new UnauthorizedException('Wrong credentials!', 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function updateUserInfo(int $userId, array $fields)
    {
        $user = User::where('id', $userId);
    }
}
