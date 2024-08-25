<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInsuranceInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ensure_id',
        'insurance_type',
        'medical_insurance_category_id',
        'medical_insurance_number',
        'doctor_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ensure()
    {
        return $this->belongsTo(Ensure::class);
    }

    public function medicalInsuranceCategory()
    {
        return $this->belongsTo(MedicalInsuranceCategory::class);
    }
}
