<?php

namespace App\Services;

use App\Models\Ensure;
use App\Models\MedicalInsuranceCategory;

class MedicalInsuranceService
{
    public function __construct()
    {

    }

    public function getAllMedicalInsuranceCategoryOptionsByLocale(int $locale = 1)
    {
        return MedicalInsuranceCategory::with('translations')->get()->map(function ($medicalInsuranceCategory) use ($locale) {
            return [
                'value' => $medicalInsuranceCategory->id,
                'name' => $this->getMedicalInsuranceCategoryTranslationByLocale($medicalInsuranceCategory, $locale)->name
            ];
        });
    }

    public function getMedicalInsuranceCategoryTranslationByLocale(MedicalInsuranceCategory $medicalInsuranceCategory, int $locale = 1)
    {
        return $medicalInsuranceCategory->translations()->where('locale_id', $locale)->first();
    }

    public function getAllEnsureOptions()
    {
        return Ensure::all()->map(function ($ensure) {
            return [
                'value' => $ensure->id,
                'name' => $ensure->name
            ];
        });
    }
}