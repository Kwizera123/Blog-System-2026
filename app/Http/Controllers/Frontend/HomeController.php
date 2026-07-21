<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])
        ->where('status','published')
        ->latest()
         ->get();
        return view('frontend.home', compact('posts'));
    }
    //

    public function show(Post $post)
    {
        return view('frontend.post', compact('post'));
    }
}
