<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $post = Post::count();
        $page = Page::count();
        $user = User::count();
        return view('admin.index', compact('post', 'page', 'user'));
    }
}
