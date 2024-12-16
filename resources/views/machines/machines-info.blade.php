@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">{{ $machine->name }} - Machine Informatie</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6 relative flex flex-col justify-between">
            <div class="absolute top-4 right-4">
                <button onclick="toggleDropdown()" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>

                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-28 bg-white border border-gray-200 rounded-md shadow-lg">
                    <a href="{{ route('machines.edit', $machine->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Bewerken</a>
                    <form action="{{ route('machines.destroy', $machine->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Verwijderen</button>
                    </form>
                </div>
            </div>

            <img src="https://via.placeholder.com/320x200" alt="{{ $machine->name }}" class="w-full h-56 object-cover mb-4 rounded-lg"> 

            <div class="mt-auto">
                <h2 class="text-2xl font-semibold mb-2">{{ $machine->name }}</h2>
                <p class="text-lg font-bold text-gray-800 mb-2">Prijs: €{{ number_format($machine->price, 2) }}</p>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4">Machineomschrijving</h3>
            <p class="text-gray-700 mb-4">
                {{ $machine->description ?? 'Deze omschrijving is tijdelijk niet beschikbaar. Dit product biedt geweldige prestaties en betrouwbaarheid. Met een strak ontwerp en eenvoudige bediening is het een uitstekende keuze voor dagelijks gebruik.' }}
            </p>
            <p class="text-gray-700 mb-4">
                Onze machines zijn ontworpen met oog voor kwaliteit en duurzaamheid. Dit model biedt hoge efficiëntie en betrouwbaarheid, ideaal voor elke setting. Ontdek de toegevoegde waarde die deze machine kan bieden in jouw dagelijks leven!
            </p>
            <p class="text-gray-700 mb-4">
                Deze machine is vervaardigd uit hoogwaardige materialen en voldoet aan de strengste normen. We streven ernaar om jou de beste ervaring te bieden, met een product dat zowel functioneel als stijlvol is.
            </p>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }
</script>

@endsection
