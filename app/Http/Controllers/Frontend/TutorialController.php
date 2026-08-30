<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\Category;
use App\Models\Tag;

class TutorialController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')
            ->select('id', 'name')
            ->get();

        $tags = Tag::orderBy('name')
            ->select('id', 'name')
            ->get();

        $tutorials = Tutorial::with([
            'user',
            'category',
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
                    });
            });
        })

        // Category filter
        ->when($request->filled('category'), function ($query) use ($request) {

            $query->where('category_id', $request->category);
        })

          // Tag filter
          ->when($request->filled('tag'), function ($query) use ($request) {
            $query->whereHas('tags', function ($tagQuery) use ($request) {
                $tagQuery->where('tags.id', $request->tag);
            });
          })

        // Latest tutorials first
        ->latest()

        // Pagination
        ->paginate(5)

        ->withQueryString();

        return view('tutorials', compact(
            'tutorials',
            'categories',
            'tags'
        ));
    }// End Method

    public function show(Tutorial $tutorial) 
    {
        $tutorial->increment('views');
        
        abort_if($tutorial->status !== 'published', 404);
        $tutorial->load([
            'user',
            'category',
            'tags',
        ]);

        $tagIds = $tutorial->tags->pluck('id');

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        //Find the previous published tutorial
        $previousTutorial = Tutorial::where('status','published')
            ->where('created_at','<', $tutorial->created_at)
            ->latest()
            ->first();

        //find the next published tutorial
        $nextTutorial = Tutorial::where('status','published')
            ->where('created_at', '>', $tutorial->created_at)
            ->oldest()
            ->first();

        //
        $relatedTutorials = Tutorial::with([
            'user',
            'category',
            'tags',
        ])
        ->where('status', 'published')
        ->where('id','!=',$tutorial->id)
        ->where(function ($query) use ($tagIds, $tutorial) {
            $query->where('category_id', $tutorial->category_id)

            ->orWhereHas('tags', function ($tagQuery) use ($tagIds) {
                $tagQuery->whereIn('tags.id', $tagIds);
            });
        })
      
        
        ->latest()
        ->take(3)
        ->get();

        return view('tutorials.show', compact(
            'tutorial',
            'categories',
            'tags',
            'previousTutorial',
            'nextTutorial',
            'relatedTutorials'
            ));
    }//End Method
}
