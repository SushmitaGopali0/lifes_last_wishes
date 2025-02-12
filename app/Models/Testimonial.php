<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $fillable = ['email', 'title', 'message', 'job_title', 'company', 'website', 'status', 'is_featured'];
}
