<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // Toon de productoverzichtspagina met alle producten
    public function index()
    {
        $products = Product::all();
        return view('products.products-show', compact('products'));
    }

    // app/Http/Controllers/ProductController.php

    public function create()
    {
        return view('products.products-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'amount' => 'required',
            'ean' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
            'amount' => $request->amount,
            'ean' => $request->ean,
        ]);

        session()->flash('success', 'Product succesvol aangemaakt!');

        return redirect()->route('products');
    }

    // app/Http/Controllers/ProductController.php

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.products-edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'amount' => 'required',
            'ean' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
            'amount' => $request->amount,
            'ean' => $request->ean,
        ]);

        session()->flash('success', 'Product succesvol bewerkt!');

        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('success', 'Product succesvol verwijderd!');

        return redirect()->route('products');
    }

    // Toon de detailpagina voor een specifiek product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.products-info', compact('product'));
    }
    public function buy(Product $product)
    {
        return view('products.products-buy-in', compact('product'));
    }

    public function storeOrder(Request $request, Product $product)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Order::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'date' => now(),
        ]);

        return redirect()->route('products.show')->with('success', 'Bestelling geplaatst!');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        // Zoek alleen in de kolom 'name'
        $products = \App\Models\Product::where('name', 'LIKE', "%{$query}%")
                                        ->limit(5)
                                        ->get();

        // Geef de producten terug als JSON
        return response()->json($products);
    }

}
