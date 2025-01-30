@extends('layouts.app')

@section('title', 'Marketing Head Dashboard')

@section('content')
    @if (session('error'))
        <div class="bg-red-400 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-4">Stock Head Dashboard</h1>
        <h2 class="text-1xl font-normal mb-4">Bestellingen in afwachting van goedkeuring</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ($pendingOrders as $order)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-bold mb-2">Bestelling #{{ $order->id }}</h2>
                    <p>Product: {{ $order->product->name }}</p>
                    <p>Aantal: {{ $order->orderLines->sum('quantity') }}</p>
                    <p>Totaal: €{{ number_format($order->orderLines->sum('total_price'), 2) }}</p>
                    <p>Status: <span class="text-yellow-500">{{ ucfirst($order->approval_status) }}</span></p>
                    <div class="flex justify-start">
                        <form action="{{ route('orders.approve', $order->id) }}" method="POST" class="mr-4">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                  </svg>

                            </button>
                        </form>
                        <form action="{{ route('orders.reject', $order->id) }}" method="POST" >
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                  </svg>

                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
