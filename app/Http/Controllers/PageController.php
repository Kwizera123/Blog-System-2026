<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\Category;
use App\Models\ContactPage;
use App\Models\Tag;
use App\Models\ContactMessage;

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
    //end Methos

    public function contact()
    {
        $contact = ContactPage::first();

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('contact', compact(
            'contact',
            'categories',
            'tags'
            ));
    }
    // End Method

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($validated);

        return redirect()
                ->route('contact')
                ->with('success', 'Your message has been sent successfully.');
    }
}
