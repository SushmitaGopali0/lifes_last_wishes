<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $fillable = ['title', 'slug', 'page_category_id', 'excerpt', 'body', 'image', 'meta_description', 'meta_keywords', 'status'];

    public function pagecategory()
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id');
    }
}
