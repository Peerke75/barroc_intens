<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserId;

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

        $approvalStatus = $quantity >= 5000 ? 'pending' : 'approved';

        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => $request->user_id,
            'date' => now(),
            'approval_status' => $approvalStatus,
        ]);

        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $quantity * $product->price,
        ]);

        if ($approvalStatus === 'approved') {
            $product->amount += $quantity;
            $product->save();
        }

        return redirect()->route('products.info', ['id' => $product->id])
        ->with('success', $approvalStatus === 'approved' ? 'Bestelling is succesvol geplaatst!' : null)
        ->with('warning', $approvalStatus !== 'approved' ? 'Bestelling is in afwachting van goedkeuring.' : null);
    }

    public function approveOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Deze bestelling is al verwerkt.');
        }

        $order->approval_status = 'approved';
        $order->save();

        $product = $order->product;
        $quantity = $order->orderLines->sum('quantity');
        $product->amount += $quantity;
        $product->save();

        return redirect()->route('products.info', ['id' => $product->id])
        ->with('success', 'Bestelling is goedgekeurd en voorraad is bijgewerkt.');
    }

    public function rejectOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Deze bestelling is al verwerkt.');
        }

        $order->approval_status = 'rejected';
        $order->save();

        return redirect()->route('products.info', ['id' => $order->product->id])
            ->with('warning', 'Bestelling is afgekeurd.');
    }

}
