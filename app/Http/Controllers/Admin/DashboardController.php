<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\ContactMessage;
use App\Models\Tutorial;



class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalComments = Comment::count();
        $pendingComments = Comment::where('status','pending')->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $publishPosts = Post::where('status','published')->count();
        $draftPosts = Post::where('status','draft')->count();
        
        

        $recentPosts = Post::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        $mostViewedPosts = Post::with('user', 'category')
            ->orderByDesc('views')
            ->take(5)
            ->get();
        
        $mostViewedTutorials = Tutorial::orderByDesc('views')
            ->take(5)
            ->get();



        $mostViewedContent = collect()
            ->merge(
                $mostViewedPosts->map(function ($post) {
                    return [
                        'title' => $post->title,
                        'type' => 'Post',
                        'views' => $post->views,
                        'url' => route('posts.show', $post),
                    ];
                })
            )
            ->merge(
                $mostViewedTutorials->map(function ($tutorial) {
                    return [
                        'title' => $tutorial->title,
                        'type' => 'Tutorial',
                        'views' => $tutorial->views,
                        'url' => route('tutorials.show', $tutorial->slug),
                    ];
                })
            )
            ->sortByDesc('views')
            ->take(5)
            ->values();

        $latestUsers = User::latest()
            ->take(5)
            ->get();

         $recentComments = Comment::with(['user','post'])
            ->latest()
            ->take(5)
            ->get();
        $recentContactMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        $totalPostViews = Post::sum('views');

        $totalTutorialViews = Tutorial::sum('views');

        $totalContentViews = $totalPostViews + $totalTutorialViews;

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPosts',
            'totalComments',
            'pendingComments',
            'unreadMessages',
            'totalCategories',
            'totalTags',
            'recentPosts',
            'latestUsers',
            'recentContactMessages',
            'recentComments',
            'publishPosts',
            'draftPosts',
            'mostViewedPosts',
            'mostViewedTutorials',
            'totalContentViews',
            'mostViewedContent',
            'totalPostViews',
            'totalTutorialViews'

        ));
       

    }
    //method Ends

}
