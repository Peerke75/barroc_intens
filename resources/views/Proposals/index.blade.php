@extends('layouts.app')

@section('content')
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
    <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-semibold text-gray-800">Offertes</h1>

            <div class="relative mb-6 max-w-md mx-auto">
                <input type="text" id="proposal-search" placeholder="Zoek offerte..."
                    class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    style="background-color: #ffffff; color: #000;">

                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                </ul>
            </div>



            <a href="{{ route('proposals.create') }}"
                class="bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                Nieuwe Offerte
            </a>
        </div>

        <ul class="space-y-6">
            @foreach ($proposals as $proposal)
                <li class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-700">
                                Offerte voor: {{ $proposal->customer->company_name ?? 'Onbekend' }} -
                                {{ $proposal->date->format('d-m-Y') }}
                            </h3>
                            <p class="text-sm text-gray-500">Offerte ID: #{{ $proposal->id }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('proposals.show', $proposal) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">Bekijk</a>
                            <a href="{{ route('proposals.downloadPdf', $proposal->id) }}"
                                class="text-yellow-500 hover:text-yellow-600 text-sm font-medium transition duration-300">Download
                                PDF</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('proposal-search');
            const resultsContainer = document.getElementById('search-results');

            searchInput.addEventListener('input', function() {
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
                                        window.location.href =
                                            `/proposals/${proposal.id}`;
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

            document.addEventListener('click', function(event) {
                if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                    resultsContainer.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
