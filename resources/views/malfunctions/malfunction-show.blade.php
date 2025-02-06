@extends('layouts.app')

@section('title', 'Barroc Intens | Storing Klant')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-brown-800 mb-6">☕ Storing Pagina</h1>

        <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6">
            <div class="flex flex-wrap md:flex-nowrap">
                <!-- Klantinformatie -->
                <div class="w-full md:w-1/2 mb-6 md:mb-0">
                    <h2 class="text-xl font-semibold text-brown-700 mb-4">📋 Klantinformatie</h2>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="mb-2"><span class="font-bold text-brown-800">Klant:</span>
                            {{ $malfunction->customer->name }}</p>
                        <p class="mb-2"><span class="font-bold text-brown-800">Bedrijf:</span>
                            {{ $malfunction->customer->company_name }}</p>
                        <p class="mb-2"><span class="font-bold text-brown-800">Datum storing:</span>
                            {{ $malfunction->date }}</p>
                        <p class="mb-2"><span class="font-bold text-brown-800">Status:</span> <span
                                class="px-2 py-1 rounded-lg text-white {{ $malfunction->status == 'Opgelost' ? 'bg-green-500' : 'bg-red-500' }}">{{ $malfunction->status }}</span>
                        </p>
                        <p class="mb-2"><span class="font-bold text-brown-800">Omschrijving:</span>
                            {{ $malfunction->message }}</p>
                        <p class="mb-2"><span class="font-bold text-brown-800">Oplossing:</span>
                            {{ $malfunction->solution }}</p>
                    </div>
                </div>

                <!-- Afbeelding -->
                <div class="w-full md:w-1/2 flex justify-center items-center">
                    @if ($malfunction->image)
                        <img src="{{ asset('storage/' . $malfunction->image) }}" alt="Storing afbeelding"
                            class="w-48 h-48 object-cover rounded-lg shadow-lg">
                    @else
                        <div class="w-48 h-48 bg-gray-200 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500">geen afbeelding</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Storingsgeschiedenis -->
            <h2 class="text-xl font-semibold text-brown-700 mt-10 mb-5">📅 Storingsgeschiedenis</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white border border-gray-300 shadow-lg rounded-lg">
                    <thead>
                        <tr class="bg-brown-700 text-white">
                            <th class="px-4 py-3 border text-left">#</th>
                            <th class="px-4 py-3 border text-left">Beschrijving</th>
                            <th class="px-4 py-3 border text-left">Datum</th>
                            <th class="px-4 py-3 border text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3 border">{{ $malfunction->id }}</td>
                            <td class="px-4 py-3 border">{{ $malfunction->message }}</td>
                            <td class="px-4 py-3 border">{{ $malfunction->date }}</td>
                            <td class="px-4 py-3 border">
                                <span
                                class="px-3 py-1 text-sm font-semibold
                                {{ $malfunction->status == 'Resolved' ? 'bg-green-500 text-white' : ($malfunction->status == 'Pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }}
                                rounded-lg shadow">
                                {{ $malfunction->status }}
                            </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
