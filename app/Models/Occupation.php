<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Occupation extends Model
{
    use HasFactory;

    protected $table = 'occupations';

    // Define the attributes that are mass assignable
    protected $fillable = ['name', 'description'];

    /**
     * Get the users that have this occupation.
     */
    public function userOccupation(): BelongsToMany
    {
        return $this->belongsToMany(UserOccupations::class);
    }

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
