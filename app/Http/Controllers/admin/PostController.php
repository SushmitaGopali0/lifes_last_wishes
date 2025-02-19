<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::paginate(10);
        return view('admin.content.posts.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|alpha_dash|unique:post,slug',
            'post_content' => 'required|string',
            'excerpt' => 'required|string',
            'categories' => 'required|array|min:1',
            'tags' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'status' => 'required|in:draft,published,pending',
            'is_featured' => 'required',
        ]);

        try {
            $image = null;
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('uploads/post', 'public');
            }

            Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->slug, '-'),
                'post_content' => $request->post_content,
                'excerpt' => $request->excerpt,
                'category' => implode(',', $request->input('categories', [])),
                'tags' => is_array($request->tags) ? implode(',', $request->tags) : implode(',', explode(',', $request->tags)),
                'image' => $image,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'seo_title' => $request->seo_title,
                'status' => $request->status,
                'is_featured' => $request->is_featured
            ]);

            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Post is stored');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.content.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.content.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|alpha_dash|unique:post,slug,' . $slug . ',slug',
            'post_content' => 'required|string',
            'excerpt' => 'required|string',
            'categories' => 'required|array|min:1',
            'tags' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'status' => 'required|in:draft,published,pending',
            'is_featured' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Find the post by slug
            $post = Post::where('slug', $slug)->firstOrFail();

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $image = $request->file('image')->store('uploads/post', 'public');
            } else {
                $image = $post->image;
            }

            // Update post
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->slug, '-'),
                'post_content' => $request->post_content,
                'excerpt' => $request->excerpt,
                'category' => implode(',', $request->input('categories', [])),
                'tags' => is_array($request->tags) ? implode(',', $request->tags) : implode(',', explode(',', $request->tags)),
                'image' => $image,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'seo_title' => $request->seo_title,
                'status' => $request->status,
                'is_featured' => $request->is_featured
            ]);

            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try{
            DB::beginTransaction();
            $post = Post::where('slug', $slug)->firstOrFail();
            $post->delete();
            DB::commit();
            return back()->with('success', 'Post is deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Post deletion is failed. Please try again.' . $e->getMessage());
        }
    }
}
