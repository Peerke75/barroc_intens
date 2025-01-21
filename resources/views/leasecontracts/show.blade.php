@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Leasecontract Details</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Bekijk alle informatie over dit leasecontract.</p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <!-- Klant -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Klant</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->customer->name }}</dd>
                </div>
                
                <!-- Gebruiker -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Gebruiker</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->user->name }}</dd>
                </div>
                
                <!-- Startdatum -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Startdatum</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->start_date }}</dd>
                </div>
                
                <!-- Einddatum -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Einddatum</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->end_date }}</dd>
                </div>
                
                <!-- Betaalmethode -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Betaalmethode</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->payment_method }}</dd>
                </div>
                
                <!-- Aantal Machines -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Aantal Machines</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->machine_amount }}</dd>
                </div>
                
                <!-- Opzegtermijn -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Opzegtermijn</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $leaseContract->notice_period }}</dd>
                </div>
                
                <!-- Status -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $leaseContract->status === 'active' ? 'bg-green-100 text-green-800' : ($leaseContract->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($leaseContract->status) }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="mt-6 flex justify-end">
        <a href="{{ route('leasecontracts.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Terug naar overzicht</a>
        <a href="{{ route('leasecontracts.edit', $leaseContract->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Bewerken</a>
    </div>
</div>
@endsection
