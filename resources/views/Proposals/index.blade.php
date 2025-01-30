@extends('layouts.app')

@section('content')
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

            <a href="{{ route('proposals.create') }}" class="bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
                Nieuwe Offerte
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-yellow-500">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-black">Bedrijf</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-black">Contact persoon</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-black">Gemaakt door</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-black">Datum</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-black">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($proposals as $proposal)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="px-6 py-4 text-gray-800">{{ $proposal->customer->company_name ?? 'Onbekend' }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $proposal->customer->name ?? 'Onbekend' }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $proposal->user->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $proposal->date->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                      </svg>
                                </a>
                                <a href="{{ route('proposals.downloadPdf', $proposal->id) }}" class="text-yellow-500 hover:text-yellow-600 text-sm font-medium transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                      </svg>

                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                                listItem.classList.add('p-3', 'hover:bg-yellow-200', 'cursor-pointer', 'text-gray-800', 'border-b', 'border-gray-200');
                                listItem.innerHTML = `<span class="font-semibold">${proposal.customer ? proposal.customer.company_name : 'Onbekend'}</span> - Offerte ID: #${proposal.id}`;
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
