@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Leasecontracten</h1>
    
    <a href="{{ route('leasecontracts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mb-6 inline-block">
        Nieuw Leasecontract
    </a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">ID</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Klant</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Gebruiker</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Startdatum</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Einddatum</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Status</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaseContracts as $contract)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">{{ $contract->id }}</td>
                    <td class="py-3 px-4 border-b">{{ $contract->customer->name }}</td>
                    <td class="py-3 px-4 border-b">{{ $contract->user->name }}</td>
                    <td class="py-3 px-4 border-b">{{ $contract->start_date }}</td>
                    <td class="py-3 px-4 border-b">{{ $contract->end_date }}</td>
                    <td class="py-3 px-4 border-b">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $contract->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $contract->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $contract->status === 'terminated' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $contract->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                            {{ ucfirst($contract->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 border-b flex space-x-2">
                        <a href="{{ route('leasecontracts.edit', $contract->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded">
                           Bewerken
                        </a>
                        <form action="{{ route('leasecontracts.destroy', $contract->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded"
                                    onclick="return confirm('Weet je zeker dat je dit leasecontract wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $leaseContracts->links('pagination::tailwind') }}
    </div>
</div>
@endsection
