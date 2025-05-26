<?php

namespace App\Http\Controllers;

use App\Models\Floodgate;
use Illuminate\Http\Request;

class FloodgateController extends Controller
{
    private function getDashboardStats()
    {
        return [
            'total_gates' => Floodgate::count(),
            'open_gates' => Floodgate::where('status', 'open')->count(),
            'closed_gates' => Floodgate::where('status', 'close')->count(),
            'pumps_active' => Floodgate::where('pump_status', 'open')->count(),
            'pumps_inactive' => Floodgate::where('pump_status', 'close')->count(),
        ];
    }

    public function index()
    {
        \$all_floodgates = Floodgate::orderBy('id')->paginate(15);
        \$dashboard_stats = \$this->getDashboardStats();
        
        return view('welcome', [
            'all_floodgates' => \$all_floodgates,
            'dashboard_stats' => \$dashboard_stats,
        ]);
    }

    public function search(Request \$request)
    {
        \$validated = \$request->validate([
            'floodgate_id' => 'required|digits:5',
        ]);

        \$floodgate_id = \$validated['floodgate_id'];
        \$search_result = Floodgate::find(\$floodgate_id);
        \$all_floodgates = Floodgate::orderBy('id')->paginate(15);
        \$dashboard_stats = \$this->getDashboardStats();

        return view('welcome', [
            'search_result' => \$search_result,
            'searched_id' => \$floodgate_id,
            'all_floodgates' => \$all_floodgates,
            'dashboard_stats' => \$dashboard_stats,
        ]);
    }
}
