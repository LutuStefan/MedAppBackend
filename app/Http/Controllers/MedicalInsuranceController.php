<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use App\Services\MedicalInsuranceService;
use Illuminate\Http\Request;

class MedicalInsuranceController extends Controller
{
    private $medicalInsuranceService;
    public function __construct(MedicalInsuranceService $medicalInsuranceService)
    {
        $this->medicalInsuranceService = $medicalInsuranceService;
    }

    public function getAllMedicalInsuranceCategoryOptions(string $lang)
    {
        $localeId = Locale::where('code', $lang)->first()->id;
        return $this->medicalInsuranceService->getAllMedicalInsuranceCategoryOptionsByLocale($localeId);
    }

    public function getAllEnsureOptions()
    {
        return $this->medicalInsuranceService->getAllEnsureOptions();
    }
}
