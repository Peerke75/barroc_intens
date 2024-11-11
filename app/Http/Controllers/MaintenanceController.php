<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Malfunction;

class MaintenanceController extends Controller
{
    public function index()
    {
        $malfunctions = Malfunction::orderBy('date', 'asc')->get();

        return view('storingen', compact('malfunctions'));
    }
}
