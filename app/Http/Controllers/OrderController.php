<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;
        $totalPrice = $quantity * $product->price;

        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => $request->user_id, 
            'date' => now(),
        ]);

        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice, 
        ]);

        $product->amount += $quantity;
        $product->save();

        return redirect()->route('products.info', ['id' => $product->id])
            ->with('success', 'Bestelling is succesvol geplaatst!');
    }
}
