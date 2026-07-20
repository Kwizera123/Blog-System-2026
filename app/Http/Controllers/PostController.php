<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'category'])

        ->when($request->filled('search'), function ($query) use ($request){
        $query->where('title', 'like', '%' . $request->search . '%');
        })

        ->when($request->sort === 'oldest', function($query) {
            $query->oldest();
        })
        ->when($request->sort === 'title_asc', function($query){
            $query->orderBy('title','asc');
        })
          ->when($request->sort === 'title_desc', function($query){
            $query->orderBy('title','desc');
        })

          ->when(!$request->filled('sort'), function($query){
            $query->latest();
        })

        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('backend.posts.index', compact('posts'));
    }
    public function myPosts()

    {
        $posts = auth()->user()
        ->posts()
        ->latest()
        ->get();

        return view('backend.posts.my-posts', compact('posts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('backend.posts.create', compact('categories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'dimensions:min_width=300,min_height=200',
        ]);

        $imagePath = null;
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts','public');
        }

        //Upload Image()This works wery well
        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request
        //         ->file('image')
        //         ->store('posts', 'public');
        // }

        // Save the Date
        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $validated['image'] ?? null,
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'user_id' => auth()->id(),
            
        ]);
        // Redirect with success message
        return redirect()
        ->route('posts.index')
        ->with('success', 'Post created successfully!');
        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
                $post->load([
            'comments.user'
        ]);
        return view('backend.posts.show', compact('post'));
        //
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::orderBy('name')->get();

        return view('backend.posts.edit', compact('post','categories'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
       $this->authorize('update', $post);

    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'dimensions:min_width=300,min_height=200',
    ]);

    $imagePath = $post->image;

    if($request->hasfile('image')) {
        //Delete old Image
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        //Upload new Image (Works well too)
        // $validated['image'] = $request
        //         ->file('image')
        //         ->store('posts', 'public');
    }

    $imagePath = $request->file('image')->store('posts','public');

    $post->update([
        'title' => $validated['title'],
        'content' =>$validated['content'],
        'category_id' => $validated['category_id'],
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('posts.index')
        ->with('success', 'Post updated successfully!');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Post $post)
    {
     
    $this->authorize('delete', $post);

    if($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()
        ->route('posts.index')
        ->with('success', 'Post deleted successfully!');
        //


    }

    
}
