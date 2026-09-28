<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\programme\Programme;
use App\Models\region\Region;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboardData = [
            'programmes' => Programme::pluck('name', 'id'),
            'donors' => Donor::pluck('name', 'id'),
            'regions' => Region::pluck('name', 'id'),
        ];

        return view('dashboard.index', compact('dashboardData'));
    }

    public function data()
    {
        return response()->json([]);
    }
}
