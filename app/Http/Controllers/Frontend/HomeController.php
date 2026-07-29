<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with([
         'user',
         'category',
         'comments',
         'tags'
         ])
        ->where('status','published')

        ->when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

            $q->where('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")

            ->orWhereHas('category', function ($category) use ($search) {
                $category->where('name', 'like', "%{$search}%");
            })

            ->orWhereHas('tags', function ($tag) use ($search) {
                $tag->where('name', 'like', "%{$search}%");
            });

            });
        })

        ->whereNotNull('slug')
        ->latest()
        ->paginate(6)
        ->withQueryString();
        // ->get();
        //return view('frontend.home', compact('posts'));
         return view('home', compact('posts'));
    }
    //

    public function show(Post $post)
    {
        return view('frontend.post', compact('post'));
    }

}
