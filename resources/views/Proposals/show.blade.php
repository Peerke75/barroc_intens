@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Succes!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <span class="text-green-700">&times;</span>
        </button>
    </div>
@endif

<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200 max-w-3xl">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Offerte voor {{ $proposal->customer->name }}</h1>

    <div class="bg-gray-50 p-6 rounded-lg shadow-sm mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Klantgegevens</h2>
        <p class="text-gray-700"><span class="font-semibold">Bedrijfsnaam:</span> {{ $proposal->customer->company_name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Klantnaam:</span> {{ $proposal->customer->name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $proposal->customer->mail }}</p>
    </div>

    <div class="mt-6 p-6 bg-gray-50 rounded-lg shadow-sm mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Prijsregels:</h2>
        <ul class="divide-y divide-gray-300">
            @foreach ($proposal->priceLines as $priceLine)
            <li class="py-2 flex justify-between items-center">
                <span class="text-gray-700">Prijs: €{{ number_format($priceLine->price, 2) }}</span>
                <span class="text-gray-700">Product: {{ $priceLine->product->name }}</span>
                <span class="text-gray-700">Aantal: {{ $priceLine->amount }}</span>
                <form action="{{ route('proposals.priceLines.destroy', $priceLine->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze prijsregel wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="flex justify-between items-center">
        <div class="text-left">
            <a href="javascript:void(0);" class="text-green-600 hover:text-green-800" id="add-line-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
    </div>

    <div id="new-line-form" class="hidden mt-4">
        <form action="{{ route('proposals.addPriceLine', $proposal->id) }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <div>
                <select name="product_id" required class="p-2 border rounded w-full product-selector">
                    <option value="">Selecteer product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="number" name="price" step="0.01" placeholder="Prijs" required readonly
                    class="p-2 border rounded w-full price-input">
            </div>
            <div>
                <input type="number" name="amount" placeholder="Aantal" required
                    class="p-2 border rounded w-full">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Opslaan
            </button>
            <button type="button" id="cancel-btn" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                Annuleren
            </button>
        </form>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <a href="{{ route('proposals.index') }}"
           class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded inline-block transition duration-200 ease-in-out shadow-sm">
            ← Terug naar Overzicht
        </a>

        <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST"
              onsubmit="return confirm('Weet je zeker dat je deze offerte wilt verwijderen?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow-md">
                Verwijder Offerte
            </button>
        </form>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-line-btn');
        const formContainer = document.getElementById('new-line-form');
        const cancelButton = document.getElementById('cancel-btn');

        addButton.addEventListener('click', function () {
            formContainer.classList.remove('hidden');
            addButton.parentElement.classList.add('hidden');
        });

        cancelButton.addEventListener('click', function () {
            formContainer.classList.add('hidden');
            addButton.parentElement.classList.remove('hidden');
        });

        document.querySelectorAll('.product-selector').forEach(select => {
            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const priceInput = this.closest('form').querySelector('.price-input');
                priceInput.value = price || '';
            });
        });
    });
</script>
@endsection
