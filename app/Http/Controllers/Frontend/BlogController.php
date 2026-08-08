<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')
            ->select('id', 'name')
            ->get();

        $tags = Tag::orderBy('name')
            ->select('id', 'name')
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
                    ->orWhere('content', 'like', "%{$search}%")

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

        // Category filter
        ->when($request->filled('category'), function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })

        // Tag filter
        ->when($request->filled('tag'), function ($query) use ($request) {
            $query->whereHas('tags', function ($tag) use ($request) {
                $tag->where('tags.id', $request->tag);
            });
        })

        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('blog', compact(
            'posts',
            'categories',
            'tags'
        ));
    }
}

