<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postCategory = PostCategory::paginate(10);
        return view('admin.content.post-categories.index', compact('postCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.post-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent' => 'nullable',
            'order' => 'required|numeric',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'slug' => 'required|alpha_dash|unique:post_category,slug'
        ]);
        try {
            DB::beginTransaction();
            PostCategory::create([
                'parent' => $request->parent,
                'order' => $request->order,
                'name' => $request->name,
                'slug' => str::slug($request->slug, '-'),
            ]);

            DB::commit();
            return redirect()->route('admin.post-category.index')->with('success', 'Post Category is stored');
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
        $postCategory = PostCategory::where('id', $id)->firstOrFail();
        return view('admin.content.post-categories.show', compact('postCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postCategory = PostCategory::where('id', $id)->firstOrFail();
        return view('admin.content.post-categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'parent' => 'nullable',
            'order' => 'required|numeric',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'slug' => 'required|alpha_dash|unique:post_category,slug,' . $id,
        ]);

        try {
            DB::beginTransaction();

            // Find the existing post category
            $postCategory = PostCategory::findOrFail($id);

            // Update the record
            $postCategory->update([
                'parent' => $request->parent,
                'order' => $request->order,
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            DB::commit();
            return redirect()->route('admin.post-category.index')->with('success', 'Post Category has been updated successfully');
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
            $postCategory = PostCategory::where('id', $id)->firstOrFail();
            $postCategory->delete();
            DB::commit();
            return back()->with('success', 'Post Category is deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Post Category deletion is failed. Please try again.' . $e->getMessage());
        }
    }
}
