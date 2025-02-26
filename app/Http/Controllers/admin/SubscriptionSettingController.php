<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriptionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define the groups you want to display under "testimonial" section
        $subscriptionGroups = ['General',
        'Payments',
        'New Customer Emails',
        'Renewal Customer Emails',
        'Admin Emails',
        'Gift Emails'];  // Add any group names you want to include

        // Fetch settings where the group is part of the specified groups
        $settings = Setting::whereIn('group', $subscriptionGroups)->get();

        // Group settings by their group name
        $groupedSettings = $settings->groupBy('group');

        // Get all unique groups for the tabs
        $groups = $settings->pluck('group')->unique();

        return view('admin.subscriptions.settings.index', compact('groups', 'groupedSettings'));

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

            return redirect()->route('admin.susbcription-setting.index')->with('success', 'Setting is stored');
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
        try {
            DB::beginTransaction();

            foreach ($request->settings as $settingId => $settingData) {
                $setting = Setting::find($settingId);
                if ($setting) {
                    // Handle file and image uploads
                    if ($request->hasFile("settings.$settingId.value")) {
                        $file = $request->file("settings.$settingId.value");

                        // Validate file type
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'docx'];
                        $extension = $file->getClientOriginalExtension();
                        if (!in_array($extension, $allowedTypes)) {
                            throw new \Exception("Invalid file type for setting: {$setting->name}");
                        }

                        // Delete old file if it exists
                        if ($setting->value && file_exists(public_path('uploads/' . $setting->value))) {
                            unlink(public_path('uploads/' . $setting->value));
                        }

                        // Save new file
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads'), $filename);
                        $setting->value = $filename;
                    } else {
                        $setting->value = $settingData['value'] ?? null;
                    }

                    // Update group
                    $setting->group = $settingData['group'] ?? $setting->group;
                    $setting->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.subscription-setting.index')->with('success', 'Settings updated successfully.');
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
