<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsuranceCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'locale'
    ];

    public function category()
    {
        return $this->belongsTo(MedicalInsuranceCategory::class);
    }
}
