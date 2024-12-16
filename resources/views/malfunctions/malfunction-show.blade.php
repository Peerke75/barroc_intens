@extends('layouts.app')
<title>Barroc Intens | Storing Klant</title>
@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Storing Pagina</h1>
    <div class="bg-white border border-gray-300 rounded-lg p-5">
        <!-- Klant informatie sectie -->
        <div class="flex">
            <div class="w-1/2">
                <h2 class="text-xl font-bold mb-5">Klant informatie</h2>
                <p class="mb-2"><span class="font-bold">Klant:</span> {{ $malfunction->customer->name }}</p>
                <p class="mb-2"><span class="font-bold">Bedrijf:</span> {{ $malfunction->customer->company_name }}</p>
                <p class="mb-2"><span class="font-bold">Datum storing:</span> {{ $malfunction->date }}</p>
                <p class="mb-2"><span class="font-bold">Status:</span> {{ $malfunction->status }}</p>
                <p class="mb-2"><span class="font-bold">Omschrijving:</span> {{ $malfunction->description }}</p>
                <p class="mb-2"><span class="font-bold">Oplossing:</span> {{ $malfunction->solution }}</p>
            </div>

            <!-- Placeholder voor afbeelding/diagram -->
            <div class="w-1/2 flex justify-center items-center">
                <div class="w-48 h-48 bg-gray-200 flex items-center justify-center">
                    <!-- Hier kan een afbeelding worden geplaatst -->
                    <span class="text-gray-500">Afbeelding</span>
                </div>
            </div>
        </div>

                <p class="mb-2"><span class="font-bold">Oplossing:</span> {{ $malfunction->solution }}</p>
            </div>
            <div class="flex justify-start mt-5">
                <a href="{{ route('agenda') }}" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Bezoek inplannen</a>
            </div>
        </div>
        
        <h2 class="text-xl font-bold mt-10 mb-5">Storingsgeschiedenis</h2>
        <table class="table-auto w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Beschrijving</th>
                    <th class="px-4 py-2 border">Datum</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Oplossing</th>
                </tr>
            </thead>
           
</table>
</div>
@endsection
