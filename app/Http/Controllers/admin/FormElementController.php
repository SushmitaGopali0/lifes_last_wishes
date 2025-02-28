<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormElement;

class FormElementController extends Controller
{
    
    // Store or Update method for elements
    public function store(Request $request)
{
    $request->validate([
        'form_group_id' => 'required',
        'type' => 'required|string',
        'label' => 'required|string',
        'pdf_label' => 'nullable|string',
        'prefilled_text_text' => 'nullable|string',
        'prefilled_text_textarea' => 'nullable|string',
        'checkbox_options' => 'nullable|array',
        'radio_options' => 'nullable|array',
        'dropdown_options' => 'nullable|array',
        'show_in_pdf' => 'required|boolean',
    ]);
 
    // store form data based on element type
    $details = [];

    if ($request->type === "TEXT" || $request->type === "TEXTAREA") {
        $details['pre_filled'] = $request->type === "TEXT" ? $request->prefilled_text_text : $request->prefilled_text_textarea;
    } elseif ($request->type === "CHECKBOX") {
        $details['options'] = array_unique(($request->checkbox_options ?? []));
    } elseif ($request->type === "RADIO") {
        $details['options'] = array_unique(($request->radio_options ?? []));
    } elseif ($request->type === "DROPDOWN") { 
        $details['options'] = array_unique(($request->dropdown_options ?? []));
    }
    
    FormElement::updateOrCreate(
        ['id' => $request->element_id], //updates if element_id exists.
        [
            'form_group_id' => $request->form_group_id,
            'type' => $request->type,
            'label' => $request->label,
            'pdf_label' => $request->pdf_label,
            'details' => $details, // Store as JSON
            'show_in_pdf' => $request->show_in_pdf,
            'order' => FormElement::where('form_group_id', $request->form_group_id)->max('order') + 1,
        ]
    );

    return redirect()->route('formgroups.customize', ['formgroup' => $request->form_group_id])
                     ->with('success', 'Element updated successfully!');
}

    public function edit($id)
    {
        $formElement = FormElement::findOrFail($id);
        return response()->json($formElement);// Return the form element as a JSON response
    }

    public function destroy($id){

    $formElement = FormElement::findOrFail($id);
    $formElement->delete();

    return redirect()->route('formgroups.customize', ['formgroup' => $formElement->form_group_id])
                     ->with('success', 'Form element deleted successfully!');
}
}
