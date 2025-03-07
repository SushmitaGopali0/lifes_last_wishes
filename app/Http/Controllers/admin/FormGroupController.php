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
   
     public function saveCondition(Request $request, $id)
     {
         $formGroup = FormGroup::findOrFail($id);
         $triggererId = $request->input('element_select');
         $condition = $request->input('condition');
         $value = $request->input('value');
         $actions = $request->input('condition_actions');
         $elements = $request->input('condition_elements');
         $conditionIndex = $request->input('condition_index');
     
         $triggerer = FormElement::findOrFail($triggererId);
         $triggererData = [
             'type' => $triggerer->type,
             'form_element_id' => $triggererId
         ];
     
         $triggered = [];
         foreach ($actions as $index => $action) {
             $triggered[] = [
                 'action' => strtolower($action),
                 'form_element_id' => $elements[$index]
             ];
         }
     
         $actionData = [
             'value' => $value,
             'condition' => strtolower(str_replace(' ', '_', $condition)),
             'triggered' => $triggered,
             'triggerer' => $triggererData
         ];
     
         // Ensure existingActions is always an array
         $existingActions = is_array($formGroup->actions) ? $formGroup->actions : [];
         
         if ($conditionIndex !== null && isset($existingActions[$conditionIndex])) {
             $existingActions[$conditionIndex] = $actionData;
         } else {
             $existingActions[] = $actionData;
         }
     
         $formGroup->actions = $existingActions;
         $formGroup->save();
     
         return redirect()->route('formgroups.condition', $id)
                          ->with('success', 'Condition saved successfully!');
     }
 
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
     
     public function condition($id)
     {
         $formGroup = FormGroup::with('elements')->findOrFail($id);
         $formElements = FormElement::where('form_group_id', $id)->get();
         
         // Ensure actions is always an array
         $savedConditions = is_array($formGroup->actions) ? $formGroup->actions : []; //load savedcondition from action column
         
         return view('admin.questionaries.form-groups.condition.index', compact('formGroup', 'formElements', 'savedConditions'));
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
