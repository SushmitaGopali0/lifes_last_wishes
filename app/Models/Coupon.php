<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $fillable = ['code', 'description', 'discount', 'status', 'start_date', 'end_date', 'used_count'];
}
