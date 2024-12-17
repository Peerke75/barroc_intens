@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Nieuwe Machine Toevoegen</h1>

        @if ($errors->any())
            <div class="text-red-500 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('machines.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium">Prijs</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                    class="w-full p-2 border border-gray-300 rounded" step="0.01" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <input type="text" name="status" id="status" value="{{ old('status') }}" 
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('status')
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
