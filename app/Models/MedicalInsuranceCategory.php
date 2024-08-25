<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsuranceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function userInsuranceInformation()
    {
        return $this->hasMany(UserInsuranceInformation::class);
    }

    public function translations()
    {
        return $this->hasMany(MedicalInsuranceCategoryTranslation::class);
    }

}
