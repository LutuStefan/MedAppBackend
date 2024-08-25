<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public const USER_ROLE_NAME = 'user';
    public const ADMIN_ROLE_NAME = 'admin';
    public const DOCTOR_ROLE_NAME = 'doctor';

    public const ROLE_NAMES = [
        self::USER_ROLE_NAME,
        self::DOCTOR_ROLE_NAME,
        self::ADMIN_ROLE_NAME
    ];

    public function getId()
    {
        return $this->id;
    }
}
