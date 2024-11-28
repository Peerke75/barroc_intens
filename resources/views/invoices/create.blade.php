@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-semibold mb-6">Maak Factuur voor: {{ $customer->name }}</h2>

    <form action="{{ route('invoice.store', $customer->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Omschrijving</label>
            <input type="text" name="description" value="{{ old('description') }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block font-medium">Prijs (€)</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block font-medium">Hoeveelheid</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full p-2 border rounded" required>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Factuur opslaan
            </button>
            <a href="{{ route('customers.show', $customer->id) }}" class="ml-4 text-gray-700 hover:underline">Annuleren</a>
        </div>
    </form>
</div>
@endsection
