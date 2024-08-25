<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use JetBrains\PhpStorm\NoReturn;

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
        $user = User::with('role')->where('email', $fields['email'])->first();
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

    /**
     * @param int $userId
     * @param array $fields
     * @return void
     */
    public function updateUserInfo(int $userId, array $fields): void
    {
        $user = User::where('id', $userId)->first();

        $user->firstName = $fields['firstName'] ?? $user->firstName;
        $user->lastName = $fields['lastName'] ?? $user->lastName;
        $user->gender = $fields['gender'] ?? $user->gender;
        $user->email = $fields['email'] ?? $user->email ;
        $user->identificationNumber = $fields['identificationNumber'] ?? $user->identificationNumber;
        $user->birthDate = $fields['birthDate'] ?? $user->birthDate;

        $user->save();
    }

    #[NoReturn] public function updateUserAddressInfo(User $user, $fields): void
    {
        $user->address = json_encode($fields);
        $user->save();
    }

    public function getUserInsuranceInfo(User $user): array
    {
        return $user->insuranceInformation->toArray();
    }

    public function getUserById(int $userId): User
    {
        return User::where('id', $userId)->first();
    }

    public function saveUserInsuranceInfo(User $user, array $fields): void
    {
        $userInsuranceInfo = $user->userInsuranceInformation->first();
        foreach ($fields as $key => $value) {
            $userInsuranceInfo->$key = $value;
        }
        $userInsuranceInfo->save();
    }
}
