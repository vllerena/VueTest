<?php

namespace App\Models;

use App\Models\Info\UserAttr;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        UserAttr::NAME,
        UserAttr::USERNAME,
        UserAttr::PASSWORD,
        UserAttr::IS_ACTIVE,
        UserAttr::IS_SUPERUSER,
        UserAttr::ROLE_ID,
    ];

    protected $table = UserAttr::TABLE_NAME;

    protected $hidden = [
        UserAttr::PASSWORD,
    ];

    protected $casts = [
        UserAttr::IS_ACTIVE => 'boolean',
        UserAttr::IS_SUPERUSER => 'boolean',
    ];

    public function getUser(): User
    {
        return $this;
    }

    public function isSuperUser()
    {
        return $this[UserAttr::IS_SUPERUSER];
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
