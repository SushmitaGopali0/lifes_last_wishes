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
    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type == 'file' || $setting->type == 'image') {
                    if ($request->hasFile($key)) {
                        $request->validate([
                            $key => 'file|mimes:jpg,png,pdf|max:2048',
                        ]);

                        if ($setting->value) {
                            Storage::disk('public')->delete($setting->value);
                        }
                        $filePath = $request->file($key)->store('settings', 'public');
                        $setting->value = $filePath;
                    }
                } else {
                    $setting->value = $value;
                }
                $setting->save();
            }
        }

        Cache::forget('settings');
        request()->flashOnly('setting_tab');

        return redirect()->route('admin.setting.index')->with('success', 'Settings updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Setting::findOrFail($id);

        // Delete the file if it's a file or image setting
        if (in_array($setting->type, ['file', 'image']) && $setting->value) {
            Storage::disk('public')->delete($setting->value);
        }

        $setting->delete();

        return redirect()->route('admin.setting.index')->with('success', 'Setting deleted successfully');
    }
}
