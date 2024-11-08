<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Retrieve the logged-in user's function_id
        $function_id = Auth::user()->function_id;
        dd($function_id);

        // Choose a dashboard view based on the function_id
        switch ($function_id) {
            case 1:
                return view('dashboard.admin'); // Admin dashboard
            case 2:
                return view('dashboard.sales'); // sales dashboard
            case 3:
                return view('dashboard.finance'); // finance dashboard
            case 4:
                return view('dashboard.maintenance'); // maintenance dashboard
            case 5:
                return view('dashboard.marketing'); // marketing dashboard 
            case 6:
                return view('dashboard.sales-head'); // Custom dashboard 
            case 7:
                return view('dashboard.finance-head'); // Custom dashboard 
            case 8:
                return view('dashboard.maintenance-head'); // Custom dashboard 
            case 9:
                return view('dashboard.marketing-head'); // Custom dashboard  
            default:
                return redirect()->route('home')->with('error', 'Dashboard not found'); // Redirect if no dashboard is found
        }
    }
}
