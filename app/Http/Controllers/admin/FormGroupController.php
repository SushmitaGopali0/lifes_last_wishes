<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FormGroup;
use App\Models\FormElement;

use Illuminate\Http\Request;

class FormGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function customize($id)
     {
         $formGroup = FormGroup::with('elements')->findOrFail($id);
         return view('admin.questionaries.form-groups.customize.index', compact('formGroup'));
     }

     public function preview($id)
     {
         $formGroup = FormGroup::with('elements')->findOrFail($id);
         return view('admin.questionaries.form-groups.preview.index', compact('formGroup'));
     }
     
     public function condition(Request $request, $id)
{
    $formGroup = FormGroup::with('elements')->findOrFail($id);
    $formElements = FormElement::where('form_group_id', $id)->get();

    // Get the selected form element ID from the request
    $selectedElementId = $request->input('form_element_id');
    $selectedElement = null;
    $options = [];

    // Fetch the selected element if an ID is provided
    if ($selectedElementId) {
        $selectedElement = FormElement::find($selectedElementId);
        
        // Fetch options only if the selected element is of type CHECKBOX, RADIO, or DROPDOWN
        if ($selectedElement && in_array($selectedElement->type, ['CHECKBOX', 'RADIO', 'DROPDOWN'])) {
            $options = $selectedElement->details['options'] ?? [];
        }
    }

    return view('admin.questionaries.form-groups.condition.index', compact('formGroup', 'formElements', 'selectedElementId', 'selectedElement', 'options'));
}
     
    public function index()
    {
    $formGroups = FormGroup::all();
    return view("admin.questionaries.form-groups.index", compact('formGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.questionaries.form-groups.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        FormGroup::create([
            'name' => $request->name,
            'actions' => json_encode($request->actions),
            'status' => $request->status,
        ]);

        return redirect()->route('formgroups.index')->with('success', 'Form Group created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formGroup = FormGroup::findOrFail($id); // Fetch the user
      
        return view('admin.questionaries.form-groups.edit', compact('formGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    {
    // dd($request->all()); // Debugging: Check what data is being sent

        $formGroup = FormGroup::findOrFail($id); 
    
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
    
        $formGroup->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
    
        return redirect()->route('formgroups.index')->with('success', 'Form Group updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formGroup = FormGroup::findOrFail($id);
        $formGroup->delete();
        return redirect()->route('formgroups.index')->with('success', 'Form Group deleted successfully.');
    }

}
