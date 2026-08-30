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
            'mostViewedPosts',
            'latestUsers',
            'recentContactMessages',
            'recentComments',
            'publishPosts',
            'draftPosts',
            'mostViewedTutorials',
            'totalContentViews'
        ));
       

    }
    //method Ends

}
