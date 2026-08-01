<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $posts = Post::with([
            'user',
            'category',
            'tags'
        ])
        ->where('status', 'published')

        // Search
        ->when($request->filled('search'), function ($query) use ($request) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

        $q->where('title', 'like', "%{$search}%")
            ->orwhere('content', 'like', "%{$search}%")

            ->orWhereHas('category', function ($category) use ($search) {
                $category->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            })

            ->orWhereHas('user', function ($user) use ($search) {
                $user->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            })

            ->orWhereHas('tags', function ($tag) use ($search) {
                $tag->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            });
        });

        })
        //Category filter
        ->when($request->filled('category'), function ($query) use ($request){
            $query->where('category_id', $request->category);
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('home', compact('posts','categories'));
    }
    //

    public function show(Post $post)
    {
        return view('frontend.post', compact('post'));
    }

}
