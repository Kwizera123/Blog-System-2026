<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;



class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;   

        $categories = Category::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}");
        })
             ->latest()
            ->paginate(10)
            ->withQueryString();

            
                   


        $totalCategories = Category::count();
        $totalPosts = \App\Models\Post::count();

        $categories = Category::withCount('posts')
           ->latest()
            ->paginate(10);

        $largestCategory = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->first();



        return view('admin.categories.index', compact(
            'categories',
            'totalPosts',
            'search',
            'totalCategories',
            'totalPosts',
            'largestCategory'
            ));
    }
    //

    public function create()
    {
        return view('admin.categories.create');
    }
    // End Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Created successfully.');
    }
    // End Method

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    // End Method
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);
        $category->update($validated);

        return redirect()
                ->route('admin.categories.index')
                ->with('info', 'Category updated successfully.');
    }
    // End Method
    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0 ) {
            return back()->with(
                'error',
                'Cannot delete a category that contains posts.'
            );
        }
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}

