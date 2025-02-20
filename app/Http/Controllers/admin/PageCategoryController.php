<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagecategory = PageCategory::paginate(10);
        return view('admin.content.page-categories.index', compact('pagecategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.page-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'slug' => 'required|alpha_dash|unique:page_categories,slug'
        ]);
        try {
            DB::beginTransaction();
            PageCategory::create([
                'name' => $request->name,
                'slug' => str::slug($request->slug, '-'),
            ]);

            DB::commit();
            return redirect()->route('admin.page-category.index')->with('success', 'Page Category is stored');
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
        $pagecategory = PageCategory::where('id', $id)->firstOrFail();
        return view('admin.content.page-categories.show', compact('pagecategory'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pagecategory = PageCategory::where('id', $id)->firstOrFail();
        return view('admin.content.page-categories.edit', compact('pagecategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'slug' => 'required|alpha_dash|unique:page_categories,slug,' . $id
        ]);
        try {
            DB::beginTransaction();
            $pagecategory = PageCategory::where('id', $id)->firstOrFail();
            $pagecategory->name = $request->name;
            $pagecategory->slug = $request->slug;
            $pagecategory->save();

            DB::commit();
            return redirect()->route('admin.page-category.index')->with('success', 'Page Category is updated');
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
            $pagecategory = PageCategory::where('id', $id)->firstOrFail();
            $pagecategory->delete();
            DB::commit();
            return back()->with('success', 'Page Category is deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Page category deletion is failed. Please try again.' . $e->getMessage());
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
        PageCategory::whereIn('id', $ids)->delete();

        return response()->json(["success" => "Page Categories are deleted"]);
    }

}
