<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Category;


class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $categories = Category::orderBy('name')->get();

    $posts = Post::with([
            'user',
            'category',
            'tags'
        ])

        // Search
        ->when($request->filled('search'), function ($query) use ($request) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($category) use ($search) {
                        $category->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', "%{$search}%");
                    });
            });

        })

        // Category Filter
        ->when($request->filled('category'), function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })

        // Status Filter
        ->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })

        // Sorting
        ->when($request->sort === 'oldest', function ($query) {
            $query->oldest();
        })
        ->when($request->sort === 'title_asc', function ($query) {
            $query->orderBy('title');
        })
        ->when($request->sort === 'title_desc', function ($query) {
            $query->orderByDesc('title');
        })
        ->when(!$request->filled('sort'), function ($query) {
            $query->latest();
        })

        ->paginate(5)
        ->withQueryString();

    return view('backend.posts.index', compact('posts', 'categories'));
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
        $tags = Tag::orderBy('name')->get();


        return view('backend.posts.create', compact('categories','tags'));
        //End Method
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
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',

            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            
        ]);

        $validated['slug'] = Post::generateSlug($validated['title']);

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
        $post = Post::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'image' => $validated['image'] ?? null,
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'video_url' => $validated['video_url'],
            'status' => $validated['status'],
            'user_id' => auth()->id(),
            
        ]);

            if($request->filled('tags')) {
                $post->tags()->attach($request->tags);
            }

        // Redirect with success message
        return redirect()
        ->route('posts.index')
        ->with('success', 'Post created successfully!');
        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
        {
            $post = Post::where('slug',$slug)
                ->with([
                    'user',
                    'category',

                     'comments' => function ($query) {
                        $query
                            ->where('status', 'approved')
                            ->latest();
                     },
                     'comments.user',
                    ])
                ->firstOrFail();
  
        return view('backend.posts.show', compact('post'));
        
        //End Method
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $post->load('tags');

        $categories = Category::orderBy('name')->get();

        $tags = Tag::orderBy('name')->get();

        return view('backend.posts.edit', compact(
            'post',
            'categories',
            'tags'
            ));
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
        'video_url' => 'nullable|url|max:255',
        'status' => 'required|in:draft,published',

        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',
    ]);

    $imagePath = $post->image;

    if($request->hasfile('image')) {
        //Delete old Image
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        $imagePath = $request->file('image')->store('posts','public');
    }

    $post->update([
        'title' => $validated['title'],
        'content' =>$validated['content'],
        'category_id' => $validated['category_id'],
        'image' => $imagePath,
        'video_url' => $validated['video_url'],
        'status' => $validated['status'],
        'slug' => Post::generateSlug($validated['title']),
    ]);
// Synchronize the selected tags.
// If no tags are selected, remove all existing tag relationships.
    $post->tags()->sync($request->input('tags', []));

    return redirect()
        ->route('posts.index')
        ->with('success', 'Post updated successfully!');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
     
    $this->authorize('delete', $post);

    if($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()
        ->route('posts.index')
        ->with('success', 'Post deleted successfully!');
        //End Method
    }

    public function publish(Post $post)
    {
        $post->update([
            'status' => 'published'
        ]);

        return back()
            ->with('success','Post published successfully.');
    }
     //End Method

         public function unpublish(Post $post)
    {
        $post->update([
            'status' => 'draft'
        ]);

        return back()
            ->with('success','Post moved back to draft.');
    }
     //End Method

    
}
