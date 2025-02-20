<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $fillable = ['user_id', 'title', 'message', 'job_title', 'company', 'website', 'status', 'is_featured'];

    public function useremail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
