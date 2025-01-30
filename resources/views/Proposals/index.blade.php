@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-8 bg-white shadow-lg rounded-lg border border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-semibold text-gray-800 mb-4 sm:mb-0">Offertes</h1>

            <div class="relative mb-6 max-w-md mx-auto w-full sm:w-1/3">
                <input type="text" id="proposal-search" placeholder="Zoek offerte..."
                class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                style="background-color: #ffffff; color: #000;">

                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                </ul>
            </div>

            <a href="{{ route('proposals.create') }}" class="bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                Nieuwe Offerte
            </a>
        </div>

        <ul class="space-y-6">
            @foreach ($proposals as $proposal)
                <li class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div class="mb-4 sm:mb-0">
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

            searchInput.addEventListener('input', function () {
                const query = searchInput.value;

                if (query.length >= 2) {
                    fetch(`/proposals/search?query=${query}`)
                        .then(response => response.json())
                        .then(data => {

                            resultsContainer.innerHTML = '';

                            if (data.length > 0) {
                                resultsContainer.classList.remove('hidden');

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

                                    listItem.innerHTML = `
                                        <span class="font-semibold">
                                            ${proposal.customer ? proposal.customer.company_name : 'Onbekend'}
                                        </span> - Offerte ID: #${proposal.id}`;

                                    listItem.addEventListener('click', () => {
                                        window.location.href = `/proposals/${proposal.id}`;
                                    });

                                    resultsContainer.appendChild(listItem);
                                });
                            } else {
                                resultsContainer.classList.add('hidden');
                            }
                        });
                } else {
                    resultsContainer.classList.add('hidden');
                }
            });

            document.addEventListener('click', function (event) {
                if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                    resultsContainer.classList.add('hidden');
                }
            });
        });
    </script>

@endsection
