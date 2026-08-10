<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;



class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tutorials = Tutorial::with([
            'user',
            'category',
        ])
        ->latest()
        ->paginate(10);

        return view('admin.tutorials.index', compact('tutorials'));
        //end Method
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $tags = Tag::orderBy('name')->get();

        return view('admin.tutorials.create', compact(
            'categories',
            'tags'
            ));
        //end Method
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $slug = Str::slug($validated['title']);

        $originalSlug = $slug;
        $counter = 1;

        while (Tutorial::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        if($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('tutorials', 'public');
        }

        $validated['slug'] = $slug;
        $validated['user_id'] = auth()->id();

        $tutorial = Tutorial::create($validated);

        $tutorial->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('admin.tutorials.index')
            ->with('success', 'Tutorial created successfully.');
        //End Method
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //End Method
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Tutorial $tutorial)
{
        $categories = Category::orderBy('name')->get();


        $tags = Tag::orderBy('name')->get();

        $tutorial->load('tags');

        return view('admin.tutorials.edit', compact(
            'categories',
            'tags',
            'tutorial'
        ));


}// End Method


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        $validated =  $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',

        ]);
          /*
    |--------------------------------------------------------------------------
    | Generate slug
    |--------------------------------------------------------------------------
    */
    $slug = Str::slug($validated['title']);

    $originalSlug = $slug;
    $counter = 1;

    while (
        Tutorial::where('slug', $slug)
            ->where('id', '!=', $tutorial->id)
            ->exists()
    ) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    $validated['slug'] = $slug;

      /*
    |--------------------------------------------------------------------------
    | Replace image
    |--------------------------------------------------------------------------
    */

    if ($request->hasfile('image')){
        //Delete old image
        if($tutorial->image) {
            Storage::disk('public')->delete($tutorial->image);
        }

        // Store new image
        $validated['image'] = $request->file('image')
            ->store('tutorials', 'public');
    }else{
        // Keep existing image
        $validated['image'] = $tutorial->image;
    }

        /*
    |--------------------------------------------------------------------------
    | Update tutorial
    |--------------------------------------------------------------------------
    */

    $tutorial->update($validated);

    $tutorial->tags()->sync($request->tags ?? []);

    return redirect()
            ->route('admin.tutorials.index')
            ->with('success', 'Tutorial updated successfully.');

        //End Method
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutorial $tutorial)
    {
        //Delete tutorial image from storage
        if($tutorial->image) {
            Storage::disk('public')->delete($tutorial->image);
        }

        // Delete tutorial from database
        $tutorial->delete();

        return redirect()
            ->route('admin.tutorials.index')
            ->with('error', 'Tutorial deleted successfullty.');
        //
    }
}
