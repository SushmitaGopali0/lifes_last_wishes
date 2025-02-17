<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pageCategory = PageCategory::all();
        $page = Page::with('pagecategory')->get();
        return view('admin.content.pages.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageCategory = PageCategory::all();
        return view('admin.content.pages.create', compact('pageCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|alpha_dash|unique:page,slug',
            'page_category' => 'nullable|exists:page_categories,id',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        try{
            $image = null;
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('uploads/photos', 'public');
            }

            Page::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'page_category_id' => $request->page_category,
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'image' => $image,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()->route('admin.page.index')->with('success', 'Page is stored');
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
