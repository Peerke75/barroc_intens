<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Malfunction;
use App\Models\Customer;

class MalfunctionsController extends Controller
{
   
    public function index()
    {
        $malfunctions = Malfunction::with('customer')->get();
        return view('malfunctions.malfunction-index', compact('malfunctions'));
    }


    public function create()
    {
        $customers = Customer::all();
        return view('malfunctions.malfunction-create', compact('customers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // Assuming a Product model
            'customer_id' => 'required|exists:customers,id',
            'message' => 'required|string|max:255',
            'status' => 'required|in:Open,Closed',
            'date' => 'required|date',
        ]);
        

        Malfunction::create($request->all());

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol aangemaakt.');
    }


    public function show($id)
    {
        $malfunction = Malfunction::findOrFail($id);
        return view('malfunctions.malfunction-show', compact('malfunction'));
    }



    public function edit($id)
    {
        $malfunction = Malfunction::findOrFail($id);
        return view('malfunctions.malfunction-edit', compact('malfunction'));
    }


    public function update(Request $request, Malfunction $malfunction)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // Assuming a Product model
            'customer_id' => 'required|exists:customers,id',
            'message' => 'required|string|max:255',
            'status' => 'required|in:Open,Closed',
            'date' => 'required|date',
        ]);
        

        $malfunction->update($request->all());

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol bijgewerkt.');
    }


    public function destroy(Malfunction $malfunction)
    {
        $malfunction->delete();

        return redirect()->route('storingen.index')->with('success', 'Storing succesvol verwijderd.');
    }
}
