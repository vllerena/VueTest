<?php

namespace App\Models;

use App\Models\Info\RoleAttr;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = RoleAttr::TABLE_NAME;

    protected $fillable = [
        RoleAttr::NAME,
        RoleAttr::PERMISSION,
    ];

    protected $casts = [
        RoleAttr::CREATED_AT => 'datetime',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
