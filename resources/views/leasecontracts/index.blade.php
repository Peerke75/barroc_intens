@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-semibold text-gray-800">Leasecontracten</h1>

        <div class="relative mb-6 max-w-md mx-auto">
            <input type="text" id="leasecontract-search" placeholder="Zoek leasecontract..."
                class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                style="background-color: #ffffff; color: #000;">
            <ul id="search-results"
                class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
            </ul>
        </div>

        <a href="{{ route('leasecontracts.create') }}" class="bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
            Nieuw Leasecontract
        </a>
    </div>

    <ul class="space-y-6">
        @foreach ($leaseContracts as $contract)
        <li class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">
                        Leasecontract voor: {{ $contract->customer->name ?? 'Onbekend' }}
                    </h3>
                    <p class="text-sm text-gray-500">Contract ID: #{{ $contract->id }}</p>
                    <p class="text-sm text-gray-500">Gebruiker: {{ $contract->user->name }}</p>
                    <p class="text-sm text-gray-500">Startdatum: {{ $contract->start_date }}</p>
                    <p class="text-sm text-gray-500">Einddatum: {{ $contract->end_date }}</p>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $contract->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $contract->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $contract->status === 'terminated' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $contract->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                        {{ ucfirst($contract->status) }}
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('leasecontracts.show', $contract->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded-lg">
                        Bekijken
                    </a>

                    <a href="{{ route('leasecontracts.edit', $contract->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-3 py-2 rounded-lg">
                        Bewerken
                    </a>

                    <form action="{{ route('leasecontracts.destroy', $contract->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-2 rounded-lg"
                            onclick="return confirm('Weet je zeker dat je dit leasecontract wilt verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                </div>

            </div>
        </li>
        @endforeach
    </ul>
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
                                            ${contract.customer ? contract.customer.name : 'Onbekend'}
                                        </span> - Contract ID: #${contract.id}`;

                                listItem.addEventListener('click', () => {
                                    window.location.href = `/leasecontracts/${contract.id}`;
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