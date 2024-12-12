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
        // Haal het product op
        $product = Product::findOrFail($productId);

        // Valideer de input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Bereken de totale prijs
        $quantity = $request->quantity;
        $totalPrice = $quantity * $product->price;

        // Maak een nieuwe bestelling aan in de orders-tabel
        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => $request->user_id, // Authenticated user
            'date' => now(),
        ]);

        // Maak een nieuwe orderregel aan in de order_lines-tabel
        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice, // Zorg dat de 'total_price' kolom bestaat in je order_lines migratie
        ]);

        // Update de hoeveelheid van het product (increment)
        $product->amount += $quantity;
        $product->save();

        // Redirect naar de info pagina van het product
        return redirect()->route('products.info', ['id' => $product->id])
            ->with('success', 'Bestelling is succesvol geplaatst en opgeslagen in Order Lines!');
    }
}
