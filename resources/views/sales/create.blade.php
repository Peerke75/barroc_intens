@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">
        {{ isset($sale) ? 'Bewerk Afspraak' : 'Nieuwe Afspraak' }}
    </h1>

    <form action="{{ isset($sale) ? route('sales.update', $sale->id) : route('sales.store') }}" method="POST">
        @csrf
        @if (isset($sale))
        @method('PUT')
        @endif

        <!-- Customer ID -->
        <div class="mb-4">
            <label for="customer_id" class="block text-gray-700 font-medium">Klant ID</label>
            <input type="number" id="customer_id" name="customer_id" value="{{ old('customer_id', $sale->customer_id ?? '') }}"
                class="w-full border rounded px-4 py-2">
            @error('customer_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- User ID -->
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 font-medium">Gebruiker ID</label>
            <input type="number" id="user_id" name="user_id" value="{{ old('user_id', $sale->user_id ?? '') }}"
                class="w-full border rounded px-4 py-2">
            @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Malfunction ID -->
        <div class="mb-4">
            <label for="malfunction_id" class="block text-gray-700 font-medium">Storing ID (optioneel)</label>
            <input type="number" id="malfunction_id" name="malfunction_id"
                value="{{ old('malfunction_id', $sale->malfunction_id ?? '') }}" class="w-full border rounded px-4 py-2">
            @error('malfunction_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium">Beschrijving</label>
            <textarea id="description" name="description" rows="3"
                class="w-full border rounded px-4 py-2">{{ old('description', $sale->description ?? '') }}</textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Priority -->
        <div class="mb-4">
            <label for="priority" class="block text-gray-700 font-medium">Prioriteit</label>
            <select type="dropdown" id="priority" name="priority" value="{{ old('priority', $sale->priority ?? '') }}"
                class="w-full border rounded px-4 py-2">
                <option value="yes" {{ old('dropdown', $sale->dropdown ?? 'no') == 'yes' ? 'selected' : '' }}>Ja</option>
                <option value="no" {{ old('dropdown', $sale->dropdown ?? 'no') == 'no' ? 'selected' : '' }}>Nee</option>
            </select>
            @error('priority') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium">Locatie</label>
            <input type="text" id="location" name="location" value="{{ old('location', $sale->location ?? '') }}"
                class="w-full border rounded px-4 py-2">
            @error('location') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-medium">Datum</label>
            <input type="date" id="date" name="date" value="{{ old('date', isset($sale) ? $sale->date->format('Y-m-d') : '') }}"
                class="w-full border rounded px-4 py-2">
            @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium">Status</label>
            <select id="status" name="status" class="w-full border rounded px-4 py-2">
                <option value="open" {{ old('status', $sale->status ?? '') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ old('status', $sale->status ?? '') == 'in_progress' ? 'selected' : '' }}>In behandeling</option>
                <option value="closed" {{ old('status', $sale->status ?? '') == 'closed' ? 'selected' : '' }}>Afgerond</option>
            </select>
            @error('status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Start Appointment -->
        <div class="mb-4">
            <label for="start_appointment" class="block text-gray-700 font-medium">Starttijd (optioneel)</label>
            <input type="time" id="start_appointment" name="start_appointment"
                value="{{ old('start_appointment', $sale->start_appointment ?? '') }}" class="w-full border rounded px-4 py-2">
            @error('start_appointment') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- End Appointment -->
        <div class="mb-4">
            <label for="end_appointment" class="block text-gray-700 font-medium">Eindtijd (optioneel)</label>
            <input type="time" id="end_appointment" name="end_appointment"
                value="{{ old('end_appointment', $sale->end_appointment ?? '') }}" class="w-full border rounded px-4 py-2">
            @error('end_appointment') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            {{ isset($sale) ? 'Bijwerken' : 'Opslaan' }}
        </button>
    </form>
</div>
@endsection