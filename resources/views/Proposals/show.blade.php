<!-- resources/views/proposals/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded shadow-lg max-w-lg">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Offerte #{{ $proposal->id }}</h1>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Klantgegevens:</h2>
        <p class="text-gray-700"><span class="font-semibold">Bedrijfsnaam:</span> {{ $proposal->customer->company_name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Klantnaam:</span> {{ $proposal->customer->name }}</p>
        <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $proposal->customer->mail }}</p>
    </div>

    <div>
        <h2 class="text-xl font-semibold text-gray-800">Prijsregels:</h2>
        <ul class="divide-y divide-gray-300">
            @foreach ($proposal->priceLines as $priceLine)
                <li class="py-2 flex justify-between">
                    <span class="text-gray-700">Prijs: €{{ number_format($priceLine->price, 2) }}</span>
                    <span class="text-gray-700">Aantal: {{ $priceLine->amount }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze offerte wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            Verwijderen
        </button>
    </form>
</div>
<div class="mb-6">
    <a href="{{ route('proposals.index') }}"class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded inline-block transition duration-200 ease-in-out shadow-sm">
       ← Go Back
    </a>
</div>

@endsection
