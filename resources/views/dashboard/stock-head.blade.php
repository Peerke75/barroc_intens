@extends('layouts.app')

@section('title', 'Stock Head Dashboard')

@section('content')
    @if (session('error'))
        <div class="bg-red-400 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Stock Head Dashboard</h1>

        <!-- 2-koloms grid voor Pending Orders en Laag in Voorraad -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Pending Orders aan de linkerkant -->
            <div class="border-r-2 border-gray-300 pr-6">
                <h2 class="text-2xl font-semibold mb-4">Bestellingen in afwachting van goedkeuring</h2>

                @if ($pendingOrders->isEmpty())
                    <p class="text-gray-500">Geen pending orders gevonden.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                        @foreach ($pendingOrders as $order)
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl p-4 border border-gray-200">
                                <h3 class="text-lg font-semibold mb-3 text-gray-800">Bestelling #{{ $order->id }}</h3>
                                <p class="text-sm text-gray-600 mb-2">Product: {{ $order->product->name ?? 'Onbekend' }}</p>
                                <p class="text-sm text-gray-600 mb-2">Aantal: {{ $order->orderLines->sum('quantity') }}</p>
                                <p class="text-sm text-gray-600 mb-2">Totaal: €{{ number_format($order->orderLines->sum('total_price'), 2) }}</p>
                                <p class="text-sm text-gray-600 mb-4">Status:
                                    <span class="text-yellow-500">{{ ucfirst($order->approval_status) }}</span>
                                </p>
                                <div class="flex justify-start mt-4">
                                    <form action="{{ route('orders.approve', $order->id) }}" method="POST" class="mr-4">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pl-6">
                <h2 class="text-2xl font-semibold mb-4">Producten Laag in Voorraad</h2>

                @if ($lowStockProducts->isEmpty())
                    <p class="text-green-600 ">Alle producten hebben voldoende voorraad.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($lowStockProducts as $product)
                            <div class="flex items-center p-4 rounded-lg shadow-lg transition-all duration-300 hover:scale-105 transform">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
                                    <p class="{{ $product->amount < 500 ? 'text-red-500' : 'text-yellow-600' }} text-sm mb-2">
                                        Voorraad: {{ $product->amount }}
                                    </p>
                                </div>

                                <a href="{{ route('products.buy', $product->id) }}" class="bg-black text-yellow-500 font-semibold py-2 px-4 rounded-lg hover:bg-yellow-500 hover:text-black transition duration-300">
                                    Bestellen
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
