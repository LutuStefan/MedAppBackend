<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOccupations extends Model
{
    use HasFactory;

    protected $table = 'user_occupations';

    protected $fillable = [
        'jobTitle',
        'companyName',
        'industry',
        'user_id',
        'occupation_id',
        'education_level_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

}
