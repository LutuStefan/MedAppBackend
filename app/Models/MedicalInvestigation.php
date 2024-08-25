<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInvestigation extends Model
{
    use HasFactory;

    protected $table = 'medical_investigations';

    protected $fillable = [
        'user_id',
        'doctor_id',
        'type',
        'date',
        'interpretation',
        'information',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
