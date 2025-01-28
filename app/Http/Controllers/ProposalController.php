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
        $products = Product::all();
        return view('proposals.show', compact('proposal', 'products'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('proposals.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'product_id.*' => 'required|exists:products,id',
            'amount.*' => 'required|integer|min:1',
        ]);

        $proposal = Proposal::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'date' => $request->date,
        ]);

        foreach ($request->product_id as $index => $product_id) {
            $product = Product::findOrFail($product_id);

            ProposalPriceLine::create([
                'proposal_id' => $proposal->id,
                'product_id' => $product_id,
                'price' => $product->price,
                'amount' => $request->amount[$index],
            ]);
        }

        return redirect()->route('proposals.show', $proposal->id)
            ->with('success', 'Offerte succesvol aangemaakt!');
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Offerte succesvol verwijderd!');
    }

    public function destroyPriceLine($id)
    {
        $priceLine = ProposalPriceLine::findOrFail($id);
        $priceLine->delete();

        return redirect()->back()->with('success', 'Prijsregel succesvol verwijderd!');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $proposals = Proposal::whereHas('customer', function ($queryBuilder) use ($query) {
            $queryBuilder->where('company_name', 'LIKE', "%{$query}%");
        })
        ->with('customer')
        ->limit(5)
        ->get();

        return response()->json($proposals);
    }

    public function addPriceLine(Request $request, $proposalId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        ProposalPriceLine::create([
            'proposal_id' => $proposalId,
            'product_id' => $request->product_id,
            'price' => $product->price,
            'amount' => $request->amount,
        ]);

        return redirect()->route('proposals.show', $proposalId)
            ->with('success', 'Prijsregel succesvol toegevoegd!');
    }

    public function removePriceLine($priceLineId)
    {
        $priceLine = ProposalPriceLine::findOrFail($priceLineId);
        $proposalId = $priceLine->proposal_id;

        $priceLine->delete();

        return redirect()->route('proposals.show', $proposalId)
            ->with('success', 'Prijsregel succesvol verwijderd!');
    }

    public function downloadPdf(Proposal $proposal, Customer $customer)
    {
        $pdf = Pdf::loadView('proposals.pdf.proposal', ['proposal' => $proposal]);

        $fileName = 'offerte-' . $proposal->customer->company_name . '.pdf';
        $filePath = 'public/temp/' . $fileName;

        Storage::put($filePath, $pdf->output());

        return $pdf->download($fileName);
    }
}
