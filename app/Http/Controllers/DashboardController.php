<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $tutorialsStarted = $user->tutorials()->count();

        $tutorialsCompleted = $user->tutorials()
            ->wherePivotNotNull('completed_at')
            ->count();

        $tutorialsInProgress = $tutorialsStarted - $tutorialsCompleted;

        $progressPercentage = $tutorialsStarted > 0
            ? round(($tutorialsCompleted / $tutorialsStarted) * 100)
            : 0;

    
        $tutorialsInProgressList = $user->tutorials()
            ->wherePivotNull('completed_at')
            ->where('status', 'published')
            ->latest('tutorial_user.created_at')

            ->take(5) // Limit to 5 tutorials
            ->get();

            return view('dashboard', compact(

                'tutorialsStarted',
                'tutorialsCompleted',
                'tutorialsInProgress',
                'progressPercentage',
                'tutorialsInProgressList'

            ) );
    }
    //
}
