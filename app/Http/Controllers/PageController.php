<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\Category;
use App\Models\Tag;

class PageController extends Controller
{
    public function about()
    {
        $about = AboutPage::with('aboutItems')->first();

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('about', compact(
            'about',
            'categories',
            'tags',
            ));
    }
    //
}
