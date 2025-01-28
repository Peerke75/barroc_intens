@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg space-y-8">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <h2 class="text-3xl font-extrabold text-gray-800 text-center">
        Maak Factuur voor: <span class="text-blue-600">{{ $customer->name }}</span>
    </h2>

    <!-- Form -->
    <form action="{{ route('invoice.store', $customer->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700">Omschrijving</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Omschrijving">
        </div>

        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700">Prijs (€)</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Prijs">
        </div>

        <div>
            <label for="quantity" class="block text-sm font-semibold text-gray-700">Hoeveelheid</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Hoeveelheid">
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-200 text-lg font-semibold">
                Factuur Opslaan
            </button>

            <!-- Cancel Link -->
            <a href="{{ route('customers.show', $customer->id) }}"
               class="text-blue-500 font-semibold hover:underline">
                Annuleren
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('invoice-items-container');
        const addButton = document.getElementById('add-item-button');

        addButton.addEventListener('click', () => {
            // Clone the default item and clear its values
            const item = document.querySelector('.invoice-item').cloneNode(true);
            item.querySelectorAll('input').forEach(input => input.value = '');
            container.appendChild(item);

            // Add event listener for the remove button
            item.querySelector('.remove-item').addEventListener('click', () => {
                item.remove();
            });
        });

        // Add remove functionality to the initial item
        document.querySelector('.remove-item').addEventListener('click', function () {
            if (container.children.length > 1) {
                this.closest('.invoice-item').remove();
            }
        });
    });
</script>
@endsection
