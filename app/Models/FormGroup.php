<?php

namespace App\Models;

use App\Models\FormElement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function elements()
    {
        return $this->hasMany(FormElement::class, 'form_group_id');
        //one formgroup have many formelement records.
    }
}
