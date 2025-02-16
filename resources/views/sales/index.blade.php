@extends('layouts.app')
<title> Barroc intens | Afspraken overzicht</title>
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

    <div class="container mx-auto mt-10 p-6 rounded-lg shadow-md">
        <div class="flex justify-between  mb-5">
            <h1 class="text-3xl font-bold mb-5">Afspraken</h1>

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
                            {{ $sale->malfunction ? $sale->malfunction->message : 'Geen' }}
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
                            <td class="px-6 py-4 flex items-center justify-center space-x-4 mt-2">
                                <a href="{{ route('sales.show', $sale->id) }}"
                                    class="flex items-center justify-center text-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>

                                <a href="{{ route('sales.edit', $sale->id) }}"
                                    class="flex items-center justify-center text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                    class="inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Weet je zeker dat je deze storing wilt verwijderen?')"
                                        class="flex items-center justify-center text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
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
