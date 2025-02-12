<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletter = Newsletter::all();
        return view('admin.newsletter.subscribers.index', compact('newsletter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsletter.subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'confirmed' => 'required',
            'subscribed' => 'required'
        ]);

        try {
            DB::beginTransaction();
            Newsletter::create([
                'email' => $request->email,
                'firstname' => $request->fname,
                'lastname' => $request->lname,
                'confirmed' => $request->confirmed,
                'subscribed' => $request->subscribed,
            ]);
            DB::commit();
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter is stored');
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
        $newsletter = Newsletter::where('id', $id)->firstOrFail();
        return view('admin.newsletter.subscribers.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $newsletter = Newsletter::where('id', $id)->firstOrFail();
        return view('admin.newsletter.subscribers.edit', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'confirmed' => 'required',
            'subscribed' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $newsletter = Newsletter::where('id', $id)->firstOrFail();
            $newsletter->email = $request->email;
            $newsletter->firstname = $request->fname;
            $newsletter->lastname = $request->lname;
            $newsletter->confirmed = $request->confirmed;
            $newsletter->subscribed = $request->subscribed;

            $newsletter->save();

            DB::commit();
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter is updated');
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
            $newsletter = Newsletter::where('id', $id)->firstOrFail();
            $newsletter->delete();
            DB::commit();
            return back()->with('success', 'Newsletter id deleted.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Newsletter deletion is failed. Please try again.' . $e->getMessage());
        }
    }
}
