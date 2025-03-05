<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plan';
    protected $fillable = ['parent_id', 'title', 'description', 'duration_length', 'duration_period', 'price_amount', 'price_currency', 'type', 'status'];

    public function parent() {
        return $this->belongsTo(Plan::class, 'parent_id');
    }

    public function member(){
        return $this->hasMany(Member::class, 'plan_id');
    }
}
