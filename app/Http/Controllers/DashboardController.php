<?php
namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\LeaseContract;
use App\Models\Product;
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
                return view('dashboard.stock');
            case 5:
                $leaseContracts = LeaseContract::with('customer')
                ->whereNotIn('status', ['active', 'terminated'])
                ->get();
                return view('dashboard.sales-head', compact('leaseContracts',));
            case 6:
                return view('dashboard.finance-head');
            case 7:
                return view('dashboard.maintenance-head');
            case 8:
                $pendingOrders = \App\Models\Order::where('approval_status', 'pending')
                ->whereHas('orderLines', function ($query) {
                    $query->where('total_price', '>=', 5000);
                })
                ->with(['product', 'user'])
                ->get();

                $lowStockProducts = Product::where('amount', '<', 1000)
                    ->orderBy('amount', 'asc')
                    ->get();

                // We geven beide datasets door aan de view
                return view('dashboard.stock-head', compact('pendingOrders', 'lowStockProducts'));

            default:
                return redirect()->route('home')->with('error', 'Dashboard not found');
        }
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
