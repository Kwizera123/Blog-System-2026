<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);


        return view('admin.categories.index', compact('categories'));
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
}

