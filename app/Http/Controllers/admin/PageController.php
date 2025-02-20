<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pageCategory = PageCategory::all();
        $page = Page::with('pagecategory')->paginate(10);
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

        try {
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
        // dd($request->all());
        $pageCategory = PageCategory::all();
        $page = Page::where('id', $id)->firstOrFail();
        return view('admin.content.pages.show', compact('page', 'pageCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageCategory = PageCategory::all();
        $page = Page::where('id', $id)->firstOrFail();
        return view('admin.content.pages.edit', compact('page', 'pageCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|alpha_dash|unique:page,slug,' . $id . ',id',
            'page_category' => 'nullable|exists:page_categories,id',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // Find the existing page
            $page = Page::findOrFail($id);

            // Handle image upload if exists
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($page->image && Storage::exists($page->image)) {
                    Storage::delete($page->image);
                }
                // Store new image
                $imagePath = $request->file('image')->store('uploads/photos', 'public');
            } else {
                // Keep the old image
                $imagePath = $page->image;
            }

            // Update page record
            $page->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'page_category_id' => $request->page_category,
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'image' => $imagePath,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.page.index')->with('success', 'Page updated successfully');
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
            $page = Page::where('id', $id)->firstOrFail();
            $page->delete();
            DB::commit();
            return back()->with('success', 'Page is deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Page deletion is failed. Please try again.' . $e->getMessage());
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
        Page::whereIn('id', $ids)->delete();

        return response()->json(["success" => "Pages are deleted"]);
    }
}


