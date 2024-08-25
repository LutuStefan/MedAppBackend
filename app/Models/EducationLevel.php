<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;

    protected $table = 'education_levels';

    protected $fillable = ['name', 'description'];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function getTranslation($locale)
    {
        $translation = $this->translations->where('locale', $locale)->where('field', 'name')->first();
        return $translation ? $translation->value : $this->name;
    }
}
