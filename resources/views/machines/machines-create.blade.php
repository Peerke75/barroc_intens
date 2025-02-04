@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Nieuwe Machine Toevoegen</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('machines.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Prijs</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Actief</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactief</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Onderhoud</option>
            </select>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Omschrijving</label>
            <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all">
                Machine Toevoegen
            </button>
        </div>
    </form>
</div>
@endsection
