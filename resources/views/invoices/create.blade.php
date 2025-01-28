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

        <!-- Invoice Items -->
        <div id="invoice-items-container" class="space-y-6">
            <!-- Default Item -->
            <div class="invoice-item flex flex-wrap gap-4 items-end bg-gray-50 p-4 rounded-lg shadow-md">
                <!-- Omschrijving -->
                <div class="flex-1">
                    <label for="description[]" class="block text-sm font-semibold text-gray-700 mb-1">Omschrijving</label>
                    <input type="text" name="description[]" required
                           class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Omschrijving">
                </div>

                <!-- Prijs -->
                <div class="w-1/4">
                    <label for="price[]" class="block text-sm font-semibold text-gray-700 mb-1">Prijs (€)</label>
                    <input type="number" name="price[]" step="0.01" required
                           class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Prijs">
                </div>

                <!-- Hoeveelheid -->
                <div class="w-1/4">
                    <label for="quantity[]" class="block text-sm font-semibold text-gray-700 mb-1">Hoeveelheid</label>
                    <input type="number" name="quantity[]" required
                           class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Hoeveelheid">
                </div>

                <!-- Remove Button -->
                <button type="button"
                        class="remove-item bg-red-500 text-white p-3 rounded-lg hover:bg-red-600 transition">
                    X
                </button>
            </div>
        </div>

        <!-- Add Item Button -->
        <button type="button" id="add-item-button"
                class="w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition text-lg font-semibold">
            + Voeg Item Toe
        </button>

        <!-- Form Actions -->
        <div class="flex justify-between items-center pt-6">
            <!-- Save Button -->
            <button type="submit"
                    class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition text-lg font-semibold">
                Factuur Opslaan
            </button>
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
