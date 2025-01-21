@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nieuw Leasecontract</h1>
    <form action="{{ route('leasecontracts.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Klant Select -->
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Klant</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>Selecteer een klant</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ isset($leaseContract) && $leaseContract->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Gebruiker Select -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Gebruiker</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>Selecteer een gebruiker</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ isset($leaseContract) && $leaseContract->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Startdatum -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Startdatum</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('start_date', $leaseContract->start_date ?? '') }}" required>
            </div>

            <!-- Einddatum -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Einddatum</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('end_date', $leaseContract->end_date ?? '') }}" required>
            </div>

            <!-- Betaalmethode -->
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Betaalmethode</label>
                <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="creditcard" {{ (isset($leaseContract) && $leaseContract->payment_method === 'creditcard') ? 'selected' : '' }}>Creditcard</option>
                    <option value="bank_transfer" {{ (isset($leaseContract) && $leaseContract->payment_method === 'bank_transfer') ? 'selected' : '' }}>Bankoverschrijving</option>
                    <option value="paypal" {{ (isset($leaseContract) && $leaseContract->payment_method === 'paypal') ? 'selected' : '' }}>PayPal</option>
                    <option value="cash" {{ (isset($leaseContract) && $leaseContract->payment_method === 'cash') ? 'selected' : '' }}>Contant</option>
                </select>
            </div>

            <!-- Aantal Machines -->
            <div>
                <label for="machine_amount" class="block text-sm font-medium text-gray-700">Aantal machines</label>
                <input type="number" name="machine_amount" id="machine_amount"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('machine_amount', $leaseContract->machine_amount ?? '') }}" min="1" required>
            </div>

            <!-- Opzegtermijn -->
            <div>
                <label for="notice_period" class="block text-sm font-medium text-gray-700">Opzegtermijn</label>
                <input type="text" name="notice_period" id="notice_period"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('notice_period', $leaseContract->notice_period ?? '') }}"
                    placeholder="Bijv. 1 maand" required>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="pending" {{ (isset($leaseContract) && $leaseContract->status === 'pending') ? 'selected' : '' }}>In afwachting</option>
                    <option value="active" {{ (isset($leaseContract) && $leaseContract->status === 'active') ? 'selected' : '' }}>Actief</option>
                    <option value="terminated" {{ (isset($leaseContract) && $leaseContract->status === 'terminated') ? 'selected' : '' }}>Beëindigd</option>
                    <option value="completed" {{ (isset($leaseContract) && $leaseContract->status === 'completed') ? 'selected' : '' }}>Voltooid</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Opslaan
            </button>
        </div>

</div>
@endsection