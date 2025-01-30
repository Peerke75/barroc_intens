@extends('layouts.app')

<title> Barroc Intens | Leasecontracten Overzicht</title>

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

    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold">Leasecontracten</h1>

            <div class="relative max-w-md">
                <input type="text" id="leasecontract-search" placeholder="Zoek leasecontract..."
                    class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                </ul>
            </div>

            <a href="{{ route('leasecontracts.create') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Nieuw leasecontract
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr class="bg-yellow-500">
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">ID</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Klant</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Startdatum</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Einddatum</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Status</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($leaseContracts->isEmpty())
                        <tr>
                            <td class="px-4 py-3 border text-center text-gray-500" colspan="6">Geen leasecontracten
                                gevonden.</td>
                        </tr>
                    @endif
                    @foreach ($leaseContracts as $contract)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 border-b">{{ $contract->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 border-b">
                                {{ $contract->customer->name ?? 'Onbekend' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 border-b">{{ $contract->start_date }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 border-b">{{ $contract->end_date }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 border-b">
                                <span
                                    class="px-3 py-1 rounded-lg text-white font-semibold shadow
                                    {{ $contract->status === 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $contract->status === 'active' ? 'bg-green-500' : '' }}
                                    {{ $contract->status === 'terminated' ? 'bg-red-500' : '' }}
                                    {{ $contract->status === 'completed' ? 'bg-blue-500' : '' }}">
                                    {{ ucfirst($contract->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border flex space-x-2">
                                <a href="{{ route('leasecontracts.show', $contract->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>

                                <a href="{{ route('leasecontracts.edit', $contract->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                <form action="{{ route('leasecontracts.destroy', $contract->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Weet je zeker dat je deze storing wilt verwijderen?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('leasecontract-search');
            const resultsContainer = document.getElementById('search-results');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value;

                if (query.length >= 2) {
                    fetch(`/leasecontracts/search?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            resultsContainer.innerHTML = '';

                            if (data.length > 0) {
                                resultsContainer.classList.remove('hidden');
                                data.forEach(contract => {
                                    const listItem = document.createElement('li');
                                    listItem.classList.add('p-3', 'hover:bg-yellow-200',
                                        'cursor-pointer', 'text-gray-800', 'border-b',
                                        'border-gray-200');
                                    listItem.innerHTML =
                                        `<span class="font-semibold">${contract.customer ? contract.customer.name : 'Onbekend'}</span> - Contract ID: #${contract.id}`;
                                    listItem.addEventListener('click', () => {
                                        window.location.href =
                                            `/leasecontracts/${contract.id}`;
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
