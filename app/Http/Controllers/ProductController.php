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
}
