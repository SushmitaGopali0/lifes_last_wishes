<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.testimonials.records.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'is_featured' => 'required',
            'status' => 'required'
        ]);

        try{
            DB::beginTransaction();
            Testimonial::create([
                'email' => $request->email,
                'title' => $request->title,
                'message' => $request->message,
                'job_title' => $request->job_title,
                'company' => $request->company,
                'website' => $request->website,
                'is_featured' => (int) $request->is_featured ? '1' : '0',
                'status' => (int) $request->status,
            ]);

            DB::commit();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial is stored');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.'.$e->getMessage());
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
