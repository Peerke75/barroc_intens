@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
            {{ isset($sale) ? 'Bewerk Afspraak' : 'Nieuwe Afspraak' }}
        </h1>

        <form action="{{ isset($sale) ? route('sales.update', $sale->id) : route('sales.store') }}" method="POST" class="space-y-6">
            @csrf
            @if (isset($sale))
            @method('PUT')
            @endif

            <!-- Customer ID -->
            <div class="mb-4">
                <label for="customer_id" class="block text-gray-700 font-medium">Klant ID</label>
                <select id="customer_id" name="customer_id" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $sale->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- User ID -->
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 font-medium">Gebruiker ID</label>
                <select id="user_id" name="user_id" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $sale->user_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Malfunction ID -->
            <div class="mb-4">
                <label for="malfunction_id" class="block text-gray-700 font-medium">Storing ID (optioneel)</label>
                <select id="malfunction_id" name="malfunction_id" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    @foreach ($malfunctions as $malfunction)
                        <option value="{{ $malfunction->id }}" {{ old('malfunction_id', $sale->malfunction_id ?? '') == $malfunction->id ? 'selected' : '' }}>
                            {{ $malfunction->message }}
                        </option>
                    @endforeach
                </select>
                @error('malfunction_id') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Beschrijving</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">{{ old('description', $sale->description ?? '') }}</textarea>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Priority -->
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 font-medium">Prioriteit</label>
                <select id="priority" name="priority" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                    <option value="1" {{ old('priority', $sale->priority ?? '') == '1' ? 'selected' : '' }}>Ja</option>
                    <option value="0" {{ old('priority', $sale->priority ?? '') == '0' ? 'selected' : '' }}>Nee</option>
                </select>
                @error('priority') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium">Locatie</label>
                <input type="text" id="location" name="location" value="{{ old('location', $sale->location ?? '') }}"
                    class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                @error('location') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-medium">Datum</label>
                <input type="date" id="date" name="date" value="{{ old('date', isset($sale) ? \Carbon\Carbon::parse($sale->date)->format('Y-m-d') : '') }}"
                    class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select id="status" name="status" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
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
                    value="{{ old('start_appointment', $sale->start_appointment ?? '') }}" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                @error('start_appointment') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- End Appointment -->
            <div class="mb-4">
                <label for="end_appointment" class="block text-gray-700 font-medium">Eindtijd (optioneel)</label>
                <input type="time" id="end_appointment" name="end_appointment"
                    value="{{ old('end_appointment', $sale->end_appointment ?? '') }}" class="w-full sm:w-5/5 border-2 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                @error('end_appointment') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full sm:w-5/5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                {{ isset($sale) ? 'Bijwerken' : 'Opslaan' }}
            </button>
        </form>
    </div>
</div>
@endsection
