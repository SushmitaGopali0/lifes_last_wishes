<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'slug', 'post_content', 'excerpt', 'category', 'tags', 'image', 'meta_description', 'meta_keywords', 'seo_title', 'status', 'is_featured'];
}
