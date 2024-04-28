<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function savePersonalData($id, Request $request): JsonResponse
    {
        $fields = $request->validate(
            [
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|string',
                'identificationNumber' => 'required',
                'birthDate' => 'required|date'
            ]
        );

        $this->userService->updateUserInfo($id, $fields);

        return new JsonResponse('User information updated successfully!', 200);
    }

    public function updateAddressInfo(Request $request)
    {
        $fields = $request->validate(
            [
                'area' => 'required|string',
                'city' => 'required|string',
                'region' => 'required|string',
                'street' => 'required|string',
                'country' => 'required|string',
                'building' => 'required|string',
                'citizenship' => 'required|string',
                'street_number' => 'required|string',
                'apartment' => 'required'
            ]
        );

        $user = $request->user();
        $this->userService->updateUserAddressInfo($user, $fields);
    }
}
