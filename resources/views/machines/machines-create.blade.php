@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Nieuwe Machine Toevoegen</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="text-red-500 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulier -->
        <form action="{{ route('machines.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Naam -->
            <div>
                <label for="name" class="block text-gray-700 font-medium">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Prijs -->
            <div>
                <label for="price" class="block text-gray-700 font-medium">Prijs</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                    class="w-full p-2 border border-gray-300 rounded" step="0.01" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <input type="text" name="status" id="status" value="{{ old('status') }}" 
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Opslaglocatie -->
            <div>
                <label for="storage_id" class="block text-gray-700 font-medium">Opslaglocatie</label>
                <select name="storage_id" id="storage_id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Selecteer opslaglocatie</option>
                    @foreach(\App\Models\Storage::all() as $storage)
                        <option value="{{ $storage->id }}" {{ old('storage_id') == $storage->id ? 'selected' : '' }}>
                            {{ $storage->product_names }}
                        </option>
                    @endforeach
                </select>
                @error('storage_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-start">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Machine Toevoegen
                </button>
            </div>
        </form>
    </div>
@endsection
