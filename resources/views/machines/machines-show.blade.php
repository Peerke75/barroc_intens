@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Create Machine Button -->
        <div class="mb-8 text-left">
            <a href="{{ route('machines.create') }}" style="background-color:#fdd716 ;color:#000000;"
                class="text-white py-2 px-4 rounded transition hover:bg-yellow-400">
                Machine Toevoegen
            </a>
        </div>

        <h1 class="text-3xl font-bold text-center mb-8">Machine Overzicht</h1>

        <!-- Grid met 4 kolommen op grote schermen -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($machines as $machine)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="Machine Afbeelding"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <!-- Naam van de machine weergeven in plaats van ID -->
                        <h2 class="text-xl font-semibold mb-2">{{ $machine->name }}</h2>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-lg font-bold text-gray-800">€{{ number_format($machine->price, 2) }}</p>
                        </div>
                        <a href="{{ route('machines.show', $machine->id) }}" style="background-color:#000000; color:#fdd716;"
                            class="block text-center py-2 px-4 rounded transition">Bekijk machine</a>
                    </div>
                </div>
            @endforeach

            @if (session('success'))
                <div class="p-4 rounded mb-4 text-center
                    @if (strpos(session('success'), 'toegevoegd') !== false) bg-green-500 text-white
                    @elseif(strpos(session('success'), 'bijgewerkt') !== false)
                        bg-gray-500 text-white
                    @elseif(strpos(session('success'), 'verwijderd') !== false)
                        bg-red-500 text-white @endif">
                    {{ session('success') }}
                </div>
            @endif
        </div>

    </div>
@endsection
