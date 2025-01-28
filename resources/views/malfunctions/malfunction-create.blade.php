@extends('layouts.app')
<title>Barroc Intens | Nieuwe Storing Aanmaken</title>

@section('content')
<div class="container px-3">
    <h2 class="text-lg font-semibold mb-4">Nieuwe Storing Aanmaken</h2>

    @if ($errors->any())
        <div class="text-red-500 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('storingen.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="product_id" class="block text-sm font-medium">Product</label>
            <select name="product_id" id="product_id" class="w-full border px-3 py-2" required>
                <option value="">Selecteer een product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="customer_id" class="block text-sm font-medium">Klant</label>
            <select name="customer_id" id="customer_id" class="w-full border px-3 py-2" required>
                <option value="">Selecteer een klant</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium">Bericht</label>
            <textarea name="message" id="message" class="w-full border px-3 py-2" rows="3" required>{{ old('message') }}</textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <select name="status" id="status" class="w-full border px-3 py-2" required>
                <option value="Open">Open</option>
                <option value="Closed">Gesloten</option>
            </select>
        </div>

        <div>
            <label for="date" class="block text-sm font-medium">Datum</label>
            <input type="date" name="date" id="date" class="w-full border px-3 py-2" value="{{ old('date') }}" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Opslaan</button>
        </div>
    </form>
</div>
@endsection
