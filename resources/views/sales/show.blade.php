@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-6 text-gray-800 animate__animated animate__fadeInUp">Afspraak Details</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg space-y-6 transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-gray-50">
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Klant ID:</strong>
            <span class="text-indigo-600">{{ $sale->customer_id }}</span>
        </div>
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Gebruiker ID:</strong>
            <span class="text-indigo-600">{{ $sale->user_id }}</span>
        </div>
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Beschrijving:</strong>
            <span class="text-gray-600">{{ $sale->description }}</span>
        </div>
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Locatie:</strong>
            <span class="text-green-600">{{ $sale->location }}</span>
        </div>
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Datum:</strong>
            <span class="text-blue-600">{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</span>
        </div>
        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong>Status:</strong>
            <span class="px-3 py-1 rounded-full text-xs font-semibold
                {{ $sale->status == 'open' ? 'bg-yellow-200 text-yellow-800' : '' }}
                {{ $sale->status == 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                {{ $sale->status == 'closed' ? 'bg-green-200 text-green-800' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $sale->status)) }}
            </span>
        </div>
    </div>

    <div class="mt-6 flex items-center space-x-4">
        <a href="{{ route('sales.edit', $sale->id) }}" class="px-6 py-3 bg-yellow-600 text-white rounded-md shadow-lg hover:bg-yellow-700 transform transition duration-300 hover:scale-105">
            Bewerken
        </a>
        <a href="{{ route('sales.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-md shadow-lg hover:bg-gray-700 transform transition duration-300 hover:scale-105">
            Terug naar Overzicht
        </a>
    </div>
</div>
@endsection
