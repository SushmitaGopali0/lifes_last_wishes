<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial = Testimonial::with('useremail')->paginate(10);
        return view('admin.testimonials.records.index', compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('admin.testimonials.records.create', compact('user'));
    }
    /**
     * Show (customized testimonial) the form for creating a new resource.
     */
    public function createCustomized()
    {
        return view('admin.testimonials.records.create-customized');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'is_featured' => 'required',
            'status' => 'required|in:pending,approved'
        ]);

        try {
            DB::beginTransaction();
            Testimonial::create([
                'user_id' => $request->email,
                'title' => $request->title,
                'message' => $request->message,
                'job_title' => $request->job_title,
                'company' => $request->company,
                'website' => $request->website,
                'is_featured' => (int) $request->is_featured ? '1' : '0',
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial is stored');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.' . $e->getMessage());
        }
    }

     /**
     * Store (Customized testimonial) a newly created resource in storage.
     */
    public function storeCustomized(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cemail' => 'required|email', // Email must be provided manually
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'is_featured' => 'required',
            'status' => 'required|in:pending,approved'
        ]);

        try {
            DB::beginTransaction();

            // Store customized testimonial
            Testimonial::create([
                'email' => $request->cemail, // Find user by email manually entered
                'title' => $request->title,
                'message' => $request->message,
                'job_title' => $request->job_title,
                'company' => $request->company,
                'website' => $request->website,
                'is_featured' => (int) $request->is_featured,
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()->route('admin.testimonial.index')->with('success', 'Customized Testimonial is stored');
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
        $user = User::all();
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.records.show', compact('testimonial', 'user'));
    }
    /**
     * Display the specified resource.
     */
    public function showCustomized(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.records.show-customized', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::all();
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.records.edit', compact('testimonial', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCustomized(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.records.edit-customized', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'is_featured' => 'required',
            'status' => 'required|in:pending,approved'
        ]);

        try {
            DB::beginTransaction();
            $testimonial = Testimonial::where('id', $id)->firstOrFail();
            $testimonial->user_id = $request->email;
            $testimonial->title = $request->title;
            $testimonial->message = $request->message;
            $testimonial->job_title = $request->job_title;
            $testimonial->company = $request->company;
            $testimonial->website = $request->website;
            $testimonial->is_featured = (int) $request->is_featured ? '1' : '0';
            $testimonial->status = $request->status;
            $testimonial->save();

            DB::commit();
            return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial is updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCustomized(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'cemail' => 'required|email',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'is_featured' => 'required',
            'status' => 'required|in:pending,approved'
        ]);

        try {
            DB::beginTransaction();
            $testimonial = Testimonial::where('id', $id)->firstOrFail();
            $testimonial->email = $request->cemail;
            $testimonial->title = $request->title;
            $testimonial->message = $request->message;
            $testimonial->job_title = $request->job_title;
            $testimonial->company = $request->company;
            $testimonial->website = $request->website;
            $testimonial->is_featured = (int) $request->is_featured ? '1' : '0';
            $testimonial->status = $request->status;
            $testimonial->save();

            DB::commit();
            return redirect()->route('admin.testimonial.index')->with('success', 'Customized Testimonial is updated');
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
        try{
            DB::beginTransaction();
            $testimonial = Testimonial::where('id', $id)->firstOrFail();
            $testimonial->delete();
            DB::commit();
            return back()->with('success', 'Testimonial is deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Testimonial deletion is failed. Please try again.' . $e->getMessage());
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
        Testimonial::whereIn('id', $ids)->delete();

        return response()->json(["success" => "Testimonials are deleted"]);
    }
}
