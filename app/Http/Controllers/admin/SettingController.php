<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all unique groups from the database
        $groups = Setting::distinct()->pluck('group');
        return view('admin.setting.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:settings,key',
            'type' => 'required|string',
            'group' => 'nullable|string',
            'new_group' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();
            // Determine the correct group to store
        $group = $request->new_group ? $request->new_group : $request->group;

        Setting::create([
            'name' => $request->name,
            'key' => $request->key,
            'value' => null,
            'details' => null,
            'type' => $request->type,
            'order' => Setting::max('order') + 1, // Auto increment order
            'group' => $group,
        ]);

            DB::commit();
            return redirect()->route('admin.setting.index')->with('success', 'Setting is stored');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.' . $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
