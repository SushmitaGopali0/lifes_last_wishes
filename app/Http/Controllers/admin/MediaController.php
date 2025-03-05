<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $directories = Storage::disk('public')->directories();
        $files = Storage::disk('public')->files();

        return view('admin.media.index', compact('directories', 'files'));
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|file']);
        $path = $request->file('file')->store('uploads', 'public');
        return back()->with('success', 'File uploaded successfully!');
    }

    public function createFolder(Request $request)
    {
        $request->validate(['folder_name' => 'required|string']);
        Storage::disk('public')->makeDirectory($request->folder_name);
        return back()->with('success', 'Folder created successfully!');
    }

    public function move(Request $request)
    {
        $request->validate([
            'file' => 'required|string',
            'destination' => 'required|string',
        ]);

        $from = 'public/' . $request->file;
        $to = 'public/' . $request->destination . '/' . basename($request->file);

        if (Storage::exists($from)) {
            Storage::move($from, $to);
            return back()->with('success', 'File moved successfully!');
        }
        return back()->with('error', 'File not found.');
    }

    public function rename(Request $request)
    {
        $request->validate([
            'old_name' => 'required|string',
            'new_name' => 'required|string',
        ]);

        $oldPath = 'public/' . $request->old_name;
        $newPath = 'public/' . dirname($request->old_name) . '/' . $request->new_name;

        if (Storage::exists($oldPath)) {
            Storage::move($oldPath, $newPath);
            return back()->with('success', 'File/Folder renamed successfully!');
        }
        return back()->with('error', 'File/Folder not found.');
    }

    public function delete(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $path = 'public/' . $request->name;
        if (Storage::exists($path)) {
            Storage::delete($path);
            return back()->with('success', 'File deleted successfully!');
        } elseif (Storage::exists('public/' . $request->name)) {
            Storage::deleteDirectory('public/' . $request->name);
            return back()->with('success', 'Folder deleted successfully!');
        }

        return back()->with('error', 'File/Folder not found.');
    }
}
