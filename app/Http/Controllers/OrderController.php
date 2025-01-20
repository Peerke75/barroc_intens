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

        // Stel de goedkeuringsstatus in op basis van de prijs
        $approvalStatus = $totalPrice >= 5000 ? 'pending' : 'approved';

        // Maak een nieuwe bestelling aan in de orders-tabel
        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => $request->user_id, // Authenticated user
            'date' => now(),
            'approval_status' => $approvalStatus,
        ]);

        // Maak een nieuwe orderregel aan in de order_lines-tabel
        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice, // Zorg dat de 'total_price' kolom bestaat in je order_lines migratie
        ]);

        // Alleen voorraad bijwerken als de bestelling is goedgekeurd
        if ($approvalStatus === 'approved') {
            $product->amount += $quantity;
            $product->save();
        }

        // Redirect naar de info pagina van het product
        return redirect()->route('products.info', ['id' => $product->id])
            ->with('success', $approvalStatus === 'approved'
                ? 'Bestelling is succesvol geplaatst!'
                : 'Bestelling is in afwachting van goedkeuring.');
    }

    public function approveOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Controleer of de bestelling in afwachting is
        if ($order->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Deze bestelling is al verwerkt.');
        }

        // Update goedkeuringsstatus
        $order->approval_status = 'approved';
        $order->save();

        // Update voorraad van het product
        $product = $order->product;
        $quantity = $order->orderLines->sum('quantity'); // Total quantity in order lines
        $product->amount += $quantity;
        $product->save();

        return redirect()->back()->with('success', 'Bestelling is goedgekeurd en voorraad is bijgewerkt.');
    }


}
