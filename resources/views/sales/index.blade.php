@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Afspraken Overzicht</h1>

    <a href="{{ route('sales.create') }}" class="mb-4 inline-block px-6 py-3 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition">
        Nieuwe Afspraak
    </a>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-200">
                <tr class="text-left">
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">ID</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Klant</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Gebruiker</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Storing</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Beschrijving</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Datum</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Tijd</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Locatie</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Prioriteit</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Status</th>
                    <th class="px-6 py-4 text-sm font-medium text-gray-600 border-b">Acties</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse($sales->sortByDesc('priority') as $sale)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $sale->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $sale->customer->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $sale->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">
                            {{ $sale->malfunction ? $sale->malfunction->description : 'Geen' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ \Illuminate\Support\Str::limit($sale->description, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $sale->date }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">
                            {{ \Carbon\Carbon::parse($sale->start_appointment)->format('H:i') }} - {{ \Carbon\Carbon::parse($sale->end_appointment)->format('H:i') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $sale->location }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">
                            {{ $sale->priority == 1 ? 'Ja' : 'Nee' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $sale->status == 'open' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                {{ $sale->status == 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                {{ $sale->status == 'closed' ? 'bg-green-200 text-green-800' : '' }}"
                                style="white-space: nowrap;">
                                {{ ucfirst(str_replace('_', ' ', $sale->status)) }}
                            </span>
                        </td>


                        <td class="px-6 py-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('sales.show', $sale->id) }}" class="inline-block px-4 py-2 text-sm bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                                    Bekijken
                                </a>
                                <a href="{{ route('sales.edit', $sale->id) }}" class="inline-block px-4 py-2 text-sm bg-yellow-600 text-white rounded-md shadow hover:bg-yellow-700 transition">
                                    Bewerken
                                </a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-4 py-2 text-sm bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center px-6 py-4 text-gray-500">Geen afspraken gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
