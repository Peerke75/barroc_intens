<?php
namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $function_id = Auth::user()->function_id;

        switch ($function_id) {
            case 0:
                return view('dashboard.admin');
            case 1:
                return view('dashboard.sales');
            case 2:
                return view('dashboard.finance');
            case 3:
                return view('dashboard.maintenance');
            case 4:
                return view('dashboard.marketing');
            case 5:
                return view('dashboard.sales-head');
            case 6:
                return view('dashboard.finance-head');
            case 7:
                return view('dashboard.maintenance-head');
            case 8:
                return view('dashboard.marketing-head');
            default:
                return redirect()->route('home')->with('error', 'Dashboard not found');
        }
    }
    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
