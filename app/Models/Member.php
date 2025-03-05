<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
