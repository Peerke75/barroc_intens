@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded shadow-lg max-w-lg">
    <!-- Titel -->
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Offerte #{{ $proposal->id }}</h1>

    <!-- Klantgegevens -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Klantgegevens:</h2>
        <p class="text-gray-700"><span class="font-semibold">Bedrijfsnaam:</span> {{ $proposal->customer->company_name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Klantnaam:</span> {{ $proposal->customer->name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $proposal->customer->mail }}</p>
    </div>

    <!-- Prijsregels overzicht -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-800">Prijsregels:</h2>
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
        <a href="{{ route('proposals.edit', $proposal->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </a>

    </div>
    <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze offerte wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow mt-6">
            Verwijder Offerte
        </button>
    </form>

</div>
<div class="mt-6">

        <!-- Go Back knop -->
        <div class="mt-6">
            <a href="{{ route('proposals.index') }}" class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded inline-block transition duration-200 ease-in-out shadow-sm">
                ← Go Back
            </a>
        </div>
</div>
@endsection
