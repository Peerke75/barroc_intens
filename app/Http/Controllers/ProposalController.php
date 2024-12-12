<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\Product;
use App\Models\ProposalPriceLine;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('priceLines')->get();
        return view('proposals.index', compact('proposals'));
    }

    public function show($id)
    {
        $proposal = Proposal::with('customer', 'priceLines.product')->findOrFail($id);
        $products = Product::all(); // Haal alle producten op om te tonen in de dropdown

        return view('proposals.show', compact('proposal', 'products'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all(); // Haal alle producten op.
        return view('proposals.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        // Valideer de input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'product_id.*' => 'required|exists:products,id',
            'amount.*' => 'required|integer|min:1',
        ]);

        // Maak een nieuwe offerte aan
        $proposal = Proposal::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'date' => $request->date,
        ]);

        // Voeg de prijsregels toe aan de offerte
        foreach ($request->product_id as $index => $product_id) {
            $product = Product::findOrFail($product_id); // Haal de productprijs op

            ProposalPriceLine::create([
                'proposal_id' => $proposal->id,
                'product_id' => $product_id,
                'price' => $product->price, // Gebruik de prijs uit de Product-tabel
                'amount' => $request->amount[$index],
            ]);
        }

        return redirect()->route('proposals.show', $proposal->id)
            ->with('success', 'Offerte succesvol aangemaakt.');
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Offerte succesvol verwijderd.');
    }

    public function destroyPriceLine($id)
    {
        $priceLine = ProposalPriceLine::findOrFail($id);
        $priceLine->delete();

        return redirect()->back()->with('success', 'Prijsregel succesvol verwijderd.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        // Zoek op klantnaam en laad de relatie met de klant
        $proposals = Proposal::whereHas('customer', function ($queryBuilder) use ($query) {
            $queryBuilder->where('company_name', 'LIKE', "%{$query}%");
        })
        ->with('customer') // Laad klantgegevens
        ->limit(5) // Beperk het aantal resultaten
        ->get();

        return response()->json($proposals); // Retourneer resultaten als JSON
    }

    public function addPriceLine(Request $request, $proposalId)
    {
        // Valideer de invoer
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        // Haal de productprijs op
        $product = Product::findOrFail($request->product_id);

        // Maak een nieuwe prijsregel
        ProposalPriceLine::create([
            'proposal_id' => $proposalId,
            'product_id' => $request->product_id,
            'price' => $product->price, // Gebruik de prijs uit de Product-tabel
            'amount' => $request->amount,
        ]);

        return redirect()->route('proposals.show', $proposalId)
            ->with('success', 'Prijsregel succesvol toegevoegd.');
    }

    public function removePriceLine($priceLineId)
    {
        $priceLine = ProposalPriceLine::findOrFail($priceLineId);
        $proposalId = $priceLine->proposal_id;

        $priceLine->delete();

        return redirect()->route('proposals.show', $proposalId)
            ->with('success', 'Prijsregel succesvol verwijderd.');
    }

    public function downloadPdf(Proposal $proposal, Customer $customer)
    {
        // Genereer de PDF vanuit de view
        $pdf = Pdf::loadView('proposals.pdf.proposal', ['proposal' => $proposal]);

        // Definieer een tijdelijke bestandsnaam en pad
        $fileName = 'offerte-' . $proposal->customer->company_name . '.pdf';
        $filePath = 'public/temp/' . $fileName;

        // Sla de PDF tijdelijk op in de opslag
        Storage::put($filePath, $pdf->output());

        // Download de PDF direct
        return $pdf->download($fileName);
    }
}
