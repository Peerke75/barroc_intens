@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-semibold text-gray-800">Offertes</h1>

            <div class="relative mb-6 max-w-md mx-auto">
                <input type="text" id="proposal-search" placeholder="Zoek offerte..."
                    class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    style="background-color: #ffffff; color: #000;">

                <!-- Suggesties container -->
                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                    <!-- Suggesties worden hier geladen -->
                </ul>
            </div>



            <a href="{{ route('proposals.create') }}" class="bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                Nieuwe Offerte
            </a>
        </div>

        <!-- Offerte list -->
        <ul class="space-y-6">
            @foreach ($proposals as $proposal)
                <li class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-700">
                                Offerte voor: {{ $proposal->customer->company_name ?? 'Onbekend' }} - {{ $proposal->date->format('d-m-Y') }}
                            </h3>
                            <p class="text-sm text-gray-500">Offerte ID: #{{ $proposal->id }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">Bekijk</a>
                            <a href="{{ route('proposals.downloadPdf', $proposal->id) }}" class="text-yellow-500 hover:text-yellow-600 text-sm font-medium transition duration-300">Download PDF</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('proposal-search');
        const resultsContainer = document.getElementById('search-results');

        // Haal resultaten op bij het typen
        searchInput.addEventListener('input', function () {
            const query = searchInput.value;

            // Start alleen een fetch als de invoer minstens 2 karakters bevat
            if (query.length >= 2) {
                fetch(`/proposals/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {

                        // Reset de resultatenlijst
                        resultsContainer.innerHTML = '';

                        if (data.length > 0) {
                            // Maak de resultatencontainer zichtbaar
                            resultsContainer.classList.remove('hidden');

                            // Vul de resultatenlijst met data
                            data.forEach(proposal => {
                                const listItem = document.createElement('li');
                                listItem.classList.add(
                                    'p-3',
                                    'hover:bg-yellow-200',
                                    'cursor-pointer',
                                    'text-gray-800',
                                    'border-b',
                                    'border-gray-200'
                                );

                                // Voeg klantnaam en offerte-ID toe
                                listItem.innerHTML = `
                                    <span class="font-semibold">
                                        ${proposal.customer ? proposal.customer.company_name : 'Onbekend'}
                                    </span> - Offerte ID: #${proposal.id}`;

                                // Voeg een klikgebeurtenis toe
                                listItem.addEventListener('click', () => {
                                    window.location.href = `/proposals/${proposal.id}`;
                                });

                                resultsContainer.appendChild(listItem);
                            });
                        } else {
                            // Verberg de resultatencontainer als er geen resultaten zijn
                            resultsContainer.classList.add('hidden');
                        }
                    });
            } else {
                // Verberg de resultatencontainer als de invoer leeg is
                resultsContainer.classList.add('hidden');
            }
        });

        // Sluit de suggesties wanneer je buiten de zoekbalk klikt
        document.addEventListener('click', function (event) {
            if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                resultsContainer.classList.add('hidden');
            }
        });
    });

    </script>

@endsection
