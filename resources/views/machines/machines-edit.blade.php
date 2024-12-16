@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Bewerk Machine: {{ $machine->name }}</h1>

        <form action="{{ route('machines.update', $machine->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Naam -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', $machine->name) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Prijs -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Prijs</label>
                <input type="number" name="price" id="price" value="{{ old('price', $machine->price) }}" class="w-full p-2 border border-gray-300 rounded" step="0.01" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <input type="text" name="status" id="status" value="{{ old('status', $machine->status) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Flex container voor beide knoppen -->
            <div class="flex space-x-2">
                <!-- Bijwerken button -->
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Machine Bijwerken</button>
        </form>

                <!-- Verwijder button in een aparte form -->
                <form action="{{ route('machines.destroy', $machine->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze machine wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded">Verwijderen</button>
                </form>
            </div>
    </div>
@endsection
