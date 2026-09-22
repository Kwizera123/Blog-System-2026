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

            return view('dashboard', compact(

                'tutorialsStarted',
                'tutorialsCompleted',
                'tutorialsInProgress',
                'progressPercentage'

            ) );
    }
    //
}
