<?php

namespace App\Models;

use App\Models\FormGroup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormElement extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_group_id',  
        'type',
        'label',
        'pdf_label',
        'show_in_pdf',
        'details', //stores as json in database.
        'order',
    ];

    protected $casts = [
        'details' => 'array',  // Automatically cast the 'details' column to an array when retrieving from database.
    ];

  public function groups()
  {
      return $this->belongsTo(FormGroup::class, 'form_group_id');
      //each formelement belongs to only one FormGroup
  }
}
