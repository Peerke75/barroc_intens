@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Afspraak Details</h1>

    <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="text-gray-700">
            <strong class="text-gray-900">Klant ID:</strong>
            <span>{{ $sale->customer_id }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Gebruiker ID:</strong>
            <span>{{ $sale->user_id }}</span>
        </div>

        <div class="text-lg font-medium text-gray-700 flex items-center space-x-2">
            <strong class="text-gray-800">Storing Beschrijving:</strong>
            <span class="text-red-600">{{ $sale->malfunction->message ?? 'Geen omschrijving beschikbaar' }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Beschrijving:</strong>
            <span>{{ $sale->description }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Locatie:</strong>
            <span>{{ $sale->location }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Datum:</strong>
            <span>{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Starttijd:</strong>
            <span>{{ \Carbon\Carbon::parse($sale->start_appointment)->format('H:i') ?? 'N/A' }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Eindtijd:</strong>
            <span>{{ \Carbon\Carbon::parse($sale->end_appointment)->format('H:i') ?? 'N/A' }}</span>
        </div>

        <div class="text-gray-700">
            <strong class="text-gray-900">Status:</strong>
            <span class="px-3 py-1 rounded-md text-sm font-medium
                {{ $sale->status == 'open' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $sale->status == 'in_progress' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $sale->status == 'closed' ? 'bg-green-100 text-green-700' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $sale->status)) }}
            </span>
        </div>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('sales.edit', $sale->id) }}" class="px-5 py-2 bg-gray-800 text-white rounded-md shadow-md hover:bg-gray-900 transition">
            Bewerken
        </a>
        <a href="{{ route('sales.index') }}" class="px-5 py-2 bg-gray-500 text-white rounded-md shadow-md hover:bg-gray-600 transition">
            Terug naar overzicht
        </a>
    </div>
</div>
@endsection
