@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200 max-w-3xl">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Nieuwe Offerte</h1>

        <form action="{{ route('proposals.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Kiezen van de klant -->
            <div>
                <label for="customer_id" class="block font-semibold text-gray-700 mb-2">Klant</label>
                <select name="customer_id" id="customer_id" required
                    class="block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Datum van de offerte -->
            <div>
                <label for="date" class="block font-semibold text-gray-700 mb-2">Datum</label>
                <input type="date" name="date" value="{{ old('date') }}" required
                    class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
            </div>

            <!-- Dynamisch toe te voegen prijsregels -->
            <div id="price-lines" class="space-y-4">
                <div class="price-line grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700">Prijs</label>
                        <input type="number" name="price[]" step="0.01" required
                            class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                    </div>
                    <div>
                        <label for="product_id" class="block font-semibold text-gray-700">Product</label>
                        <select name="product_id[]" id="product_id" required
                            class="block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">-- Selecteer een product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700">Aantal</label>
                        <input type="number" name="amount[]" required
                            class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                    </div>
                </div>
            </div>

            <!-- Plus-icoon -->
            <div class="flex justify-end mt-4">
                <button type="button" id="add-line-btn"
                    class="flex items-center text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Prijsregel toevoegen
                </button>
            </div>

            <!-- Opslaan button -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mt-6 w-full">
                Offerte aanmaken
            </button>
        </form>
    </div>

    <script>
        document.getElementById('add-line-btn').addEventListener('click', function () {
            const container = document.getElementById('price-lines');
            const lineDiv = document.createElement('div');
            lineDiv.classList.add('price-line', 'grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4', 'mt-4');
            lineDiv.innerHTML = `
                <div>
                    <label class="block font-semibold text-gray-700">Prijs</label>
                    <input type="number" name="price[]" step="0.01" required
                        class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Product</label>
                    <select name="product_id[]" required
                        class="block w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">-- Selecteer een product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Aantal</label>
                    <input type="number" name="amount[]" required
                        class="w-full p-3 border rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
            `;
            container.appendChild(lineDiv);
        });
    </script>
@endsection
