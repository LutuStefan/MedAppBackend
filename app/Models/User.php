<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'role_id',
        'identificationNumber',
//        'birthDate',
        'gender',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthDate' => 'datetime',
    ];

    public function userInsuranceInformation(): HasMany
    {
        return $this->hasMany(UserInsuranceInformation::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getRole()
    {
        return $this->role()->first();
    }

    public function occupations()
    {
        return $this->belongsToMany(Occupation::class, 'user_occupations')
            ->withPivot('education_level_id');
    }

    public function userOccupation()
    {
        return $this->hasMany(UserOccupations::class);
    }

    public function educationLevels()
    {
        return $this->belongsToMany(EducationLevel::class, 'user_occupations')
            ->withPivot('occupation_id');
    }

    public function medicalInvestigations(): HasMany
    {
        return $this->hasMany(MedicalInvestigation::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user_one_id');
    }

    public function conversationsWith(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user_two_id');
    }
}
