<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Bid;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'klien') {
            $projects = Project::where('client_id', $user->id)
                ->withCount('bids')
                ->latest()
                ->get();

            $totalProjects = $projects->count();
            $openProjects = $projects->where('status', 'terbuka')->count();
            $closedProjects = $projects->where('status', 'ditutup')->count();

            return view('dashboard', compact(
                'projects',
                'totalProjects',
                'openProjects',
                'closedProjects'
            ));
        }

        if ($user->role === 'developer') {
            $bids = Bid::where('developer_id', $user->id)
                ->with('project')
                ->latest()
                ->get();

            $totalBids = $bids->count();
            $winningBids = $bids->where('is_winner', true)->count();

            $openProjects = Project::where('status', 'terbuka')->count();

            return view('dashboard', compact(
                'bids',
                'totalBids',
                'winningBids',
                'openProjects'
            ));
        }

        $totalUsers = User::count();
        $totalClients = User::where('role', 'klien')->count();
        $totalDevelopers = User::where('role', 'developer')->count();
        $totalProjects = Project::count();
        $totalBids = Bid::count();
        $openProjects = Project::where('status', 'terbuka')->count();
        $closedProjects = Project::where('status', 'ditutup')->count();

        return view('dashboard', compact(
            'totalUsers',
            'totalClients',
            'totalDevelopers',
            'totalProjects',
            'totalBids',
            'openProjects',
            'closedProjects'
        ));
    }
}