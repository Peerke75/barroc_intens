@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded shadow-lg max-w-lg">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Bewerk Offerte #{{ $proposal->id }}</h1>

    <div class="mt-6 p-4 bg-gray-100 rounded shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Prijsregel toevoegen</h2>
        <form action="{{ route('proposals.addPriceLine', $proposal->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="product_id" class="block font-semibold text-gray-700">Product</label>
                <select name="product_id" id="product_id" required class="block w-full p-2 border rounded bg-white">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="price" class="block font-semibold text-gray-700">Prijs</label>
                <input type="number" name="price" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="amount" class="block font-semibold text-gray-700">Aantal</label>
                <input type="number" name="amount" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                Prijsregel toevoegen
            </button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('proposals.show', $proposal->id) }}" class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded inline-block transition duration-200 ease-in-out shadow-sm">
            ← Terug naar Offerte
        </a>
    </div>
</div>
@endsection
