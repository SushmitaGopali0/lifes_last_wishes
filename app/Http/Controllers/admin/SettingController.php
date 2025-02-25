<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all unique groups from the database
        $groups = Setting::distinct()->pluck('group');
        $settings = Setting::all()->groupBy('group');
        return view('admin.setting.index', compact('groups', 'settings'));
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
            $group = $request->new_group ?: $request->group;

            Setting::create([
                'name' => $request->name,
                'key' => $request->key ?? Str::slug($request->name, '_'),
                'value' => $request->type === 'checkbox' ? 0 : null,
                'details' => null,
                'type' => $request->type,
                'order' => Setting::max('order') + 1,
                'group' => $group,
            ]);

            DB::commit();
            Cache::forget('settings');

            return redirect()->route('admin.setting.index')->with('success', 'Setting is stored');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. ' . $e->getMessage());
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
    // public function update(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         if (!$request->has('settings') || !is_array($request->settings)) {
    //             return back()->with('error', 'No settings found to update.');
    //         }

    //         foreach ($request->settings as $settingId => $settingData) {
    //             $setting = Setting::find($settingId);
    //             if ($setting) {
    //                 $setting->value = $settingData['value'] ?? ''; // Ensure 'value' exists
    //                 $setting->group = $settingData['group'] ?? ''; // Ensure 'group' exists
    //                 $setting->save();
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('admin.setting.index')->with('success', 'Settings updated successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Something went wrong. ' . $e->getMessage());
    //     }
    // }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->settings as $settingId => $settingData) {
                $setting = Setting::find($settingId);
                if ($setting) {
                    // Handle file and image uploads
                    if (isset($settingData['value']) && $request->hasFile("settings.$settingId.value")) {
                        $file = $request->file("settings.$settingId.value");
                        $filename = time() . '_' . $file->getClientOriginalName(); // Preserve original filename
                        $file->move(public_path('uploads'), $filename);
                        $setting->value = $filename; // Save only the filename
                    } else {
                        $setting->value = $settingData['value'] ?? null;
                    }

                    // Update group
                    $setting->group = $settingData['group'] ?? $setting->group;
                    $setting->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.setting.index')->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. ' . $e->getMessage());
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $setting = Setting::findOrFail($id);
            $setting->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete setting']);
        }
    }
}
