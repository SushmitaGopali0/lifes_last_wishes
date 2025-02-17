<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    protected $table = 'page_categories';
    protected $fillable = ['name', 'slug'];
    public function page()
    {
        return $this->hasMany(Page::class, 'page_category_id');
    }
}
