<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Proposal;
use App\Models\ProposalPriceLine;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('priceLines')->get();
        return view('proposals.index', compact('proposals'));
    }

// ProposalController.php
public function create()
    {
        $customers = Customer::all();
        return view('proposals.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // Valideer de input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'price.*' => 'required|numeric|min:0',
            'amount.*' => 'required|integer|min:1',
        ]);

        // Maak een nieuwe offerte aan
        $proposal = Proposal::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'date' => $request->date,
        ]);

        // Voeg de prijsregels toe aan de offerte
        foreach ($request->price as $index => $price) {
            ProposalPriceLine::create([
                'proposal_id' => $proposal->id,
                'price' => $price,
                'amount' => $request->amount[$index],
            ]);
        }

        return redirect()->route('proposals.show', $proposal->id)->with('success', 'Offerte succesvol aangemaakt.');
    }


    public function show($id)
    {
        $proposal = Proposal::with('customer')->findOrFail($id);
        return view('proposals.show', compact('proposal'));
    }
    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Offerte succesvol verwijderd.');
    }
}
