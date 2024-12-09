@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200 max-w-3xl">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Nieuwe Offerte</h1>

    <form action="{{ route('proposals.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Kiezen van de klant -->
        <div>
            <label for="customer_id" class="block font-semibold text-gray-700 mb-2">Klant</label>
            <select name="customer_id" id="customer_id" required class="block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Datum van de offerte -->
        <div>
            <label for="date" class="block font-semibold text-gray-700 mb-2">Datum</label>
            <input type="date" name="date" value="{{ old('date') }}" required class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
        </div>

        <!-- Prijsregels -->
        <div id="price-lines">
            <div class="price-line mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Prijsregel 1</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="price" class="block font-semibold text-gray-700">Prijs</label>
                        <input type="number" name="price[]" step="0.01" required class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                    </div>

                    <div>
                        <label for="product_id" class="block font-semibold text-gray-700">Product</label>
                        <select name="product_id[]" id="product_id" required class="block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">-- Selecteer een product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="amount" class="block font-semibold text-gray-700">Aantal</label>
                        <input type="number" name="amount[]" required class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Button om meer regels toe te voegen -->
        <button type="button" id="add-line-btn" class="bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded-lg mt-6 w-full">
            + Prijsregel toevoegen
        </button>

        <!-- Opslaan button -->
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mt-6 w-full">
            Offerte aanmaken
        </button>
    </form>

    <script>
        document.getElementById('add-line-btn').addEventListener('click', function() {
            const container = document.getElementById('price-lines');
            const lineDiv = document.createElement('div');
            lineDiv.classList.add('price-line', 'mb-6');
            lineDiv.innerHTML = `
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Prijsregel</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700">Prijs</label>
                        <input type="number" name="price[]" class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" step="0.01" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Aantal</label>
                        <input type="number" name="amount[]" class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                </div>
            `;
            container.appendChild(lineDiv);
        });
    </script>
</div>
@endsection
