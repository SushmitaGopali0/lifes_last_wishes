<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupon = Coupon::paginate(10);
        return view('admin.subscriptions.coupons.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = Str::random(10); // Generate a random code
        return view('admin.subscriptions.coupons.create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupon,code',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date|after_or_equal:today', // Ensures start_date is today or later
            'end_date' => 'required|date|after_or_equal:start_date', // Ensures end_date is after start_date
        ]);
        try {
            DB::beginTransaction();

            Coupon::create([
                'code' => $request->code,
                'description' => $request->description,
                'discount' => $request->discount,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            DB::commit();
            return redirect()->route('admin.coupon.index')->with('success', 'Coupon is stored');
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
        $coupon = Coupon::where('id', $id)->firstOrFail();
        return view('admin.subscriptions.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $coupon = Coupon::where('id', $id)->firstOrFail();
        return view('admin.subscriptions.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required|unique:coupon,code,' . $id,
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date|after_or_equal:today', // Ensures start_date is today or later
            'end_date' => 'required|date|after_or_equal:start_date', // Ensures end_date is after start_date
        ]);
        try {
            DB::beginTransaction();

            $coupon = Coupon::where('id', $id)->firstOrFail();

            $coupon->update([
                'code' => $request->code,
                'description' => $request->description,
                'discount' => $request->discount,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            DB::commit();
            return redirect()->route('admin.coupon.index')->with('success', 'Coupon is updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $coupon = Coupon::where('id', $id)->firstOrFail();
            $coupon->delete();
            DB::commit();
            return back()->with('success', 'Coupon is deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Coupon deletion is failed. Please try again.' . $e->getMessage());
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
        Coupon::whereIn('id', $ids)->delete();

        return response()->json(["success" => "Coupons are deleted"]);
    }
}
