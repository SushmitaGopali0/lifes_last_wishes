<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormGroup;
use App\Models\FormElement;

class FormElementController extends Controller
{
   //dk
// Store method for new element and updating existing
public function store(Request $request)
{
    $request->validate([
        'form_group_id' => 'required',
        'type' => 'required|string',
        'label' => 'required|string',
        'pdf_label' => 'nullable|string',
        'prefilled_text' => 'nullable|string',
        'show_in_pdf' => 'required|boolean',
    ]);

    FormElement::updateOrCreate(
        ['id' => $request->element_id], // Update existing element if ID is provided
        [
            'form_group_id' => $request->form_group_id,
            'type' => $request->type,
            'label' => $request->label,
            'pdf_label' => $request->pdf_label,
            'details' => json_encode(['text' => $request->prefilled_text]), 
            'show_in_pdf' => $request->show_in_pdf,
            'order' => FormElement::where('form_group_id', $request->form_group_id)->max('order') + 1,
        ]
    );

    return redirect()->route('formgroups.customize', ['formgroup' => $request->form_group_id])
                     ->with('success', 'Element added/updated successfully!');
}

// Edit method for fetching data
public function edit($id)
{
    $formElement = FormElement::findOrFail($id);
    return response()->json($formElement);
}
}