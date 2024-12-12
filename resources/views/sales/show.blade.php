@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Afspraak Details</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <p><strong>Klant ID:</strong> {{ $sale->customer_id }}</p>
        <p><strong>Gebruiker ID:</strong> {{ $sale->user_id }}</p>
        <p><strong>Storing ID:</strong> {{ $sale->malfunction_id ?? 'Geen' }}</p>
        <p><strong>Beschrijving:</strong> {{ $sale->description }}</p>
        <p><strong>Prioriteit:</strong> {{ $sale->priority }}</p>
        <p><strong>Locatie:</strong> {{ $sale->location }}</p>
        <p><strong>Datum:</strong> {{ $sale->date }}</p>
        <p><strong>Status:</strong> {{ $sale->status }}</p>
        <p><strong>Starttijd:</strong> {{ $sale->start_appointment ?? 'Geen' }}</p>
        <p><strong>Eindtijd:</strong> {{ $sale->end_appointment ?? 'Geen' }}</p>
    </div>

    <a href="{{ route('sales.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">Terug naar overzicht</a>
</div>
@endsection
