<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use App\Models\Occupation;
use App\Models\User;
use App\Models\UserOccupations;
use App\Services\MedicalInsuranceService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $userService;

    public $medicalInsuranceService;

    public CONST LANGUAGES = [
        'ro' => 1,
        'en' => 2,
    ];

    public function __construct(
        UserService $userService,
        MedicalInsuranceService $medicalInsuranceService
    ) {
        $this->userService = $userService;
        $this->medicalInsuranceService = $medicalInsuranceService;
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        $user->load('role');
        return $user;
    }

    public function getUserOptions(): JsonResponse
    {
        $users = User::all('id', 'firstName', 'lastName');
        return response()->json($users->map(function($user) {
            return [
                'key' => $user->id,
                'value' => $user->firstName . ' ' . $user->lastName,
            ];
        })->toArray());
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

    public function getUserInsuranceInfo(Request $request, $lang): array
    {
        $user = $request->user();

        $medicalInsuranceCategory = $user->userInsuranceInformation->first()->medicalInsuranceCategory;
        $medicalInsuranceCategoryTranslation =  $this->medicalInsuranceService->getMedicalInsuranceCategoryTranslationByLocale(
            $medicalInsuranceCategory,
            self::LANGUAGES[$lang]
        );
        $ensure = $user->userInsuranceInformation->first()->ensure;
        $familyDrId = $user->userInsuranceInformation->first()->doctor_id;
        $familyDr = $familyDrId ? $this->userService->getUserById($familyDrId) : null;

        return [
            'ensure' =>[
                'name' => $ensure->name,
                'value' => $ensure->id
            ],
            'insurance_type' => $user->userInsuranceInformation->first()->insurance_type,
            'medical_insurance_number' => $user->userInsuranceInformation->first()->medical_insurance_number,
            'medical_insurance_category' => [
                'name' => $medicalInsuranceCategoryTranslation->name,
                'value' => $medicalInsuranceCategory->id
            ],
            'family_doctor' => [
                'firstName' => $familyDr ? $familyDr->firstName : '',
                'lastName' => $familyDr ? $familyDr->lastName : '',
            ]
        ];
    }

    public function saveUserInsuranceInfo(Request $request)
    {
        $user = $request->user();
        $fields = $request->validate(
            [
                'ensure_id' => 'required',
                'insurance_type' => 'required',
                'medical_insurance_number' => 'optional',
                'medical_insurance_category_id' => 'required',
                'family_doctor_id' => 'optional'
            ]
        );
        try {
            $this->userService->saveUserInsuranceInfo($user, $fields);
            return new JsonResponse('User insurance information saved successfully!', 200);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), 500);
        }
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $file = $request->file('avatar');
        $fileContent = file_get_contents($file);
        $fileHash = sha1($fileContent);

        // Check if the hash already exists in the database
        $existingAvatar = DB::table('users')->where('avatar_hash', $fileHash)->first();
        if ($existingAvatar) {
            return new JsonResponse(['message' => 'This image has already been uploaded.'], 422);
        }

        $user = $request->user();
        $avatarPath = $file->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->avatar_hash = $fileHash;
        $user->save();

        return new JsonResponse(['message' => 'Avatar uploaded successfully!', 'avatar' => $avatarPath], 200);
    }

    public function getUserOccupationInformation(string $lang): array
    {
        $occupationInformation = [];
        $user = auth()->user();
        $userOccupation = $user->userOccupation->first();
        $occupationInformation['industry'] = $userOccupation->industry;
        $occupationInformation['jobTitle'] = $userOccupation->jobTitle;
        $occupationInformation['companyName'] = $userOccupation->companyName;
        $occupationInformation['educationLevel'] = [
            'value' => $userOccupation->education_level_id,
            'name' => $userOccupation->educationLevel->getTranslation(strtolower($lang))
        ];
        $occupationInformation['occupation'] = [
            'value' => $userOccupation->occupation_id,
            'name' => $userOccupation->occupation->getTranslation(strtolower($lang))
        ];

        return $occupationInformation;
    }

    public function getUserOccupationOptions(string $lang): array
    {
        $occupationOptions = [];

        $occupations = Occupation::all();
        foreach ($occupations as $occupation) {
            $occupationOptions[] = [
                'value' => $occupation->id,
                'name' => $occupation->getTranslation(strtolower($lang))
            ];
        }

        return $occupationOptions;
    }

    public function getEducationLevelOptions(string $lang): array
    {
        $educationLevelOptions = [];

        $educationLevels = EducationLevel::all();
        foreach ($educationLevels as $educationLevel) {
            $educationLevelOptions[] = [
                'value' => $educationLevel->id,
                'name' => $educationLevel->getTranslation(strtolower($lang))
            ];
        }

        return $educationLevelOptions;
    }

    public function saveUserOccupationInformation(Request $request)
    {
        $request = $request->all();

        $user = auth()->user();
        $userOccupation = $user->userOccupation->first();

        if (!$userOccupation instanceof UserOccupations) {
            $userOccupation = new UserOccupations();
            $userOccupation->user_id = $user->id;
        }

        try {
            $userOccupation->industry = $request['industry'];
            $userOccupation->companyName = $request['companyName'];
            $userOccupation->occupation_id = $request['occupation']['value'];
            $userOccupation->education_level_id = $request['educationLevel']['value'];

            $userOccupation->save();
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), 500);
        }
    }
}
