@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Head of Sales Dashboard</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($leaseContracts->isEmpty())
        <p class="text-gray-500">Geen leasecontracten gevonden.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($leaseContracts as $contract)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl p-4 border border-gray-200">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">Contract #{{ $contract->id }}</h3>
                    <p class="text-sm text-gray-600 mb-2">Klant: {{ $contract->customer->name ?? 'Onbekend' }}</p>
                    <p class="text-sm text-gray-600 mb-2">Startdatum: {{ \Carbon\Carbon::parse($contract->start_date)->format('d-m-Y') }}</p>
                    <p class="text-sm text-gray-600 mb-2">Einddatum: {{ \Carbon\Carbon::parse($contract->end_date)->format('d-m-Y') }}</p>
                    <p class="text-sm text-gray-600 mb-4">Status:
                        <span class="@if($contract->status == 'pending') text-yellow-500
                                     @elseif($contract->status == 'active') text-green-500
                                     @else text-red-500 @endif">
                            {{ ucfirst($contract->status) }}
                        </span>
                    </p>

                    <div class="flex justify-start mt-4">
                        @if ($contract->status == 'pending')
                            <form action="{{ route('leaseContracts.approve', $contract->id) }}" method="POST" class="mr-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('leaseContracts.reject', $contract->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
