<!-- resources/views/proposals/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded shadow-lg max-w-lg">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Nieuwe Offerte</h1>

    <form action="{{ route('proposals.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Kiezen van de klant -->
        <div>
            <label for="customer_id" class="block font-semibold mb-1 text-gray-700">Klant</label>
            <select name="customer_id" id="customer_id" required class="block w-full p-2 border rounded bg-white">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Datum van de offerte -->
        <div>
            <label for="date" class="block font-semibold mb-1 text-gray-700">Datum</label>
            <input type="date" name="date" value="{{ old('date') }}" required class="w-full p-2 border rounded">
        </div>

        <!-- Prijsregels -->
        <div id="price-lines">
            <div class="price-line mb-4">
                <label for="price" class="block font-semibold text-gray-700">Prijs</label>
                <input type="number" name="price[]" step="0.01" required class="w-full p-2 border rounded mb-2">

                <label for="amount" class="block font-semibold text-gray-700">Aantal</label>
                <input type="number" name="amount[]" required class="w-full p-2 border rounded">
            </div>
        </div>

        <!-- Button om meer regels toe te voegen -->
        <button type="button" id="add-line-btn" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded mt-4">
            + Prijsregel toevoegen
        </button>

        <!-- Opslaan button -->
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mt-6 w-full">Offerte aanmaken</button>
    </form>

    <script>
        document.getElementById('add-line-btn').addEventListener('click', function() {
            const container = document.getElementById('price-lines');
            const lineDiv = document.createElement('div');
            lineDiv.classList.add('price-line', 'mb-4');
            lineDiv.innerHTML = `
                <label class="block font-semibold text-gray-700">Prijs</label>
                <input type="number" name="price[]" class="w-full p-2 border rounded mb-2" step="0.01" required>
                <label class="block font-semibold text-gray-700">Aantal</label>
                <input type="number" name="amount[]" class="w-full p-2 border rounded" required>
            `;
            container.appendChild(lineDiv);
        });
    </script>
</div>
@endsection
