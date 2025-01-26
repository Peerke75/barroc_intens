@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Maak Factuur voor: {{ $customer->name }}</h2>

    <form action="{{ route('invoice.store', $customer->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700">Omschrijving</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Omschrijving">
        </div>

        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700">Prijs (€)</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Prijs">
        </div>

        <div>
            <label for="quantity" class="block text-sm font-semibold text-gray-700">Hoeveelheid</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Hoeveelheid">
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-200 text-lg font-semibold">
                Factuur Opslaan
            </button>
            <a href="{{ route('customers.show', $customer->id) }}" class="text-blue-500 font-semibold hover:underline">Annuleren</a>
        </div>
    </form>
</div>
@endsection
