<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ensure extends Model
{
    use HasFactory;

    protected $table = 'ensure';

    public const DEFAULT_ENSURES = [
        'CNAS',
        'Regina Maria'
        ];
    protected $fillable = [
        'name'
    ];

    public function userInsuranceInformation()
    {
        return $this->hasMany(UserInsuranceInformation::class);
    }
}
