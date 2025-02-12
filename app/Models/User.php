<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'avatar', 'gift_token', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
//each users belongs to  one role