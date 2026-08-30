<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')
        ->select('id','name')
        ->get();
        
        

        $tags = Tag::orderBy('name')
        ->select('id','name')
        ->get();

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
        //Tag filter
        ->when($request->filled('tag'), function ($query) use ($request){
            $query->whereHas('tags', function ($tag) use ($request){
                $tag->where('tags.id', $request->tag);
            });
        })
        
        // Sorting
        ->latest()
        //pagination
        ->paginate(5)
        ->withQueryString();

        return view('home', compact('posts','categories', 'tags'));
    }
    //

    public function show(Post $post)
    {
        if(!session()->has('viewed_post_' . $post->id)) {

            $post->increment('views'); 

            session()->put(
                'viewed_post_' . $post->id,
                true
            );
        }
        

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $post->load([
            'user',
            'category',
            'tags',
            'comments' => function ($query) {
                $query
                    ->where('status', 'approved')
                    ->latest();
            },
            'comments.user',
        ]);
        return view('frontend.post', compact('post', 'categories','tags'));
    }

}
