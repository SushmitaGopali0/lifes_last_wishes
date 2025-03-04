<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan = Plan::paginate();
        return view('admin.subscriptions.plans.index', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriptions.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // Find the most recent plan for renewal (if exists)
            $latestPlan = Plan::latest()->first();

            $plan = Plan::create([
                'parent_id' => $latestPlan ? $latestPlan->id : null, // Set parent_id if a plan exists
                'title' => $request->title,
                'description' => $request->description,
                'duration_length' => $request->duration,
                'duration_period' => 'days',
                'price_amount' => $request->price,
                'price_currency' => 'AUD',
                'type' => $latestPlan ? 'Renewal' : 'General', // If a plan exists, it's a renewal; otherwise, general
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.plan.index')->with('success', 'Subscription plan created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plan::with('parent')->find($id); // Load the parent relationship

        if (!$plan) {
            return redirect()->route('admin.plan.index')->with('error', 'Plan not found.');
        }

        return view('admin.subscriptions.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan = Plan::where('id', $id)->firstOrFail();
        return view('admin.subscriptions.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // Find the most recent plan for renewal (if exists)
            $latestPlan = Plan::latest()->first();

            $plan = Plan::where('id', $id)->firstOrFail();
            $plan->update([
                'parent_id' => $latestPlan ? $latestPlan->id : null, // Set parent_id if a plan exists
                'title' => $request->title,
                'description' => $request->description,
                'duration_length' => $request->duration,
                'duration_period' => 'days',
                'price_amount' => $request->price,
                'price_currency' => 'AUD',
                'type' => $latestPlan ? 'Renewal' : 'General', // If a plan exists, it's a renewal; otherwise, general
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.plan.index')->with('success', 'Subscription plan updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $plan = Plan::where('id', $id)->firstOrFail();
            $plan->delete();
            DB::commit();
            return back()->with('success', 'Plan is deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Plan deletion is failed. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Bulk Remove the specified resource from storage.
     */
    public function destroyAll(Request $request)
    {
        if (!$request->has('ids')) {
            return response()->json(["error" => "No IDs provided"], 400);
        }

        $ids = $request->ids;
        Plan::whereIn('id', $ids)->delete();

        return response()->json(["success" => "Subscription plans are deleted"]);
    }
}
