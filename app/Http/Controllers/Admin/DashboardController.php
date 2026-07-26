<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;



class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalComments = Comment::count();
        $totalCategories = Category::count();
        $publishPosts = Post::where('status','published')->count();
        $draftPosts = Post::where('status','draft')->count();
        

        $recentPosts = Post::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        $latestUsers = User::latest()
            ->take(5)
            ->get();

         $recentComments = Comment::with(['user','post'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPosts',
            'totalComments',
            'totalCategories',
            'recentPosts',
            'latestUsers',
            'recentComments',
            'publishPosts',
            'draftPosts'
        ));
       

    }
    //method Ends

}
