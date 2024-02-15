<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $fields = $request->validate(
            [
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]
        );

        $userInformation = [
            'firstName' => $fields['firstName'],
            'lastName' => $fields['lastName'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ];

        $userDefaultRoleId = Role::where('name', Role::USER_ROLE_NAME)->first()->getId();

        if (empty($fields['role'])) {
            $userInformation['role_id'] = $userDefaultRoleId;
        }

        $userInformation = $this->userService->registerUser($userInformation);

        return response($userInformation, 200);
    }

    public function login(Request $request)
    {
        try {
            $fields = $request->validate(
                [
                    'email' => 'required|string|email',
                    'password' => 'required|string'
                ]
            );
            $userInformation = $this->userService->logIn($fields);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), 401);
        }

        return response($userInformation, 200);
    }

    public function logOut(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'user logged out'
        ];
    }
}
