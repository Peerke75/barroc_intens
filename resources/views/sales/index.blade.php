@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Afspraken Overzicht</h1>

    <a href="{{ route('sales.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Nieuwe Afspraak
    </a>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border border-gray-200">ID</th>
                    <th class="px-4 py-2 border border-gray-200">Klant ID</th>
                    <th class="px-4 py-2 border border-gray-200">Gebruiker ID</th>
                    <th class="px-4 py-2 border border-gray-200">Beschrijving</th>
                    <th class="px-4 py-2 border border-gray-200">Datum</th>
                    <th class="px-4 py-2 border border-gray-200">Status</th>
                    <th class="px-4 py-2 border border-gray-200">Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-200">{{ $sale->id }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $sale->customer_id }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $sale->user_id }}</td>
                        <td class="px-4 py-2 border border-gray-200">
                            {{ \Illuminate\Support\Str::limit($sale->description, 50) }}
                        </td>
                        <td class="px-4 py-2 border border-gray-200">{{ $sale->date }}</td>
                        <td class="px-4 py-2 border border-gray-200">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $sale->status == 'open' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                {{ $sale->status == 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                {{ $sale->status == 'closed' ? 'bg-green-200 text-green-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $sale->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('sales.show', $sale->id) }}"
                                    class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                    Bekijken
                                </a>
                                <a href="{{ route('sales.edit', $sale->id) }}"
                                    class="px-2 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                                    Bewerken
                                </a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-2 text-gray-500">Geen afspraken gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
