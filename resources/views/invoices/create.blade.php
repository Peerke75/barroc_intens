@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg space-y-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4 " role="alert">
                <strong class="font-bold">Succes!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </span>
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </span>
            </div>
        @endif

        <h2 class="text-3xl font-extrabold text-gray-800 text-center">
            Maak Factuur voor: <span class="text-blue-600">{{ $customer->name }}</span>
        </h2>

        <form action="{{ route('invoice.store', $customer->id) }}" method="POST" class="space-y-6">
            @csrf

            <div id="invoice-items-container" class="space-y-6">
                <div class="invoice-item flex flex-wrap gap-4 items-end bg-gray-50 p-4 rounded-lg shadow-md">
                    <div class="flex-1">
                        <label for="description[]"
                            class="block text-sm font-semibold text-gray-700 mb-1">Omschrijving</label>
                        <input type="text" name="description[]" required
                            class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Omschrijving">
                    </div>

                    <div class="w-1/4">
                        <label for="price[]" class="block text-sm font-semibold text-gray-700 mb-1">Prijs (€)</label>
                        <input type="number" name="price[]" step="0.01" required
                            class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Prijs">
                    </div>

                    <div class="w-1/4">
                        <label for="quantity[]" class="block text-sm font-semibold text-gray-700 mb-1">Hoeveelheid</label>
                        <input type="number" name="quantity[]" required
                            class="block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Hoeveelheid">
                    </div>

                    <button type="button"
                        class="remove-item bg-red-500 text-white p-3 rounded-lg hover:bg-red-600 transition">
                        X
                    </button>
                </div>
            </div>

            <button type="button" id="add-item-button"
                class="w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition text-lg font-semibold">
                + Voeg Item Toe
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
                    <button type="submit"
                        class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors duration-200 text-lg font-semibold">
                        Factuur Opslaan
                    </button>

                    <div class="flex justify-between items-center pt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition text-lg font-semibold">
                            Factuur Opslaan
                        </button>

                        <a href="{{ route('customers.show', $customer->id) }}"
                            class="text-blue-500 font-semibold hover:underline">
                            Annuleren
                        </a>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('invoice-items-container');
            const addButton = document.getElementById('add-item-button');

            addButton.addEventListener('click', () => {
                const item = document.querySelector('.invoice-item').cloneNode(true);
                item.querySelectorAll('input').forEach(input => input.value = '');
                container.appendChild(item);

                item.querySelector('.remove-item').addEventListener('click', () => {
                    item.remove();
                });
            });

            document.querySelector('.remove-item').addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.invoice-item').remove();
                }
            });
        });
    </script>
@endsection
