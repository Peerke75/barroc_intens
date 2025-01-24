@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mt-3 mb-6">Leasecontract Bewerken</h1>
    <form action="{{ route('leasecontracts.update', $leaseContract->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Klant</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled>Selecteer een klant</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $leaseContract->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Gebruiker</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled>Selecteer een gebruiker</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $leaseContract->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Startdatum</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('start_date', $leaseContract->start_date) }}" required>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Einddatum</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('end_date', $leaseContract->end_date) }}" required>
            </div>

            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Betaalmethode</label>
                <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="creditcard" {{ $leaseContract->payment_method === 'creditcard' ? 'selected' : '' }}>Creditcard</option>
                    <option value="bank_transfer" {{ $leaseContract->payment_method === 'bank_transfer' ? 'selected' : '' }}>Bankoverschrijving</option>
                    <option value="paypal" {{ $leaseContract->payment_method === 'paypal' ? 'selected' : '' }}>PayPal</option>
                    <option value="cash" {{ $leaseContract->payment_method === 'cash' ? 'selected' : '' }}>Contant</option>
                </select>
            </div>

            <div>
                <label for="machine_amount" class="block text-sm font-medium text-gray-700">Aantal machines</label>
                <input type="number" name="machine_amount" id="machine_amount"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('machine_amount', $leaseContract->machine_amount) }}" min="1" required>
            </div>

            <div>
                <label for="notice_period" class="block text-sm font-medium text-gray-700">Betaaltermijn</label>
                <select name="notice_period" id="notice_period" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="maandelijks" {{ $leaseContract->notice_period === 'maandelijks' ? 'selected' : '' }}>Maandelijks</option>
                    <option value="per kwartaal" {{ $leaseContract->notice_period === 'per kwartaal' ? 'selected' : '' }}>Per kwartaal</option>
                    <option value="per jaar" {{ $leaseContract->notice_period === 'per jaar' ? 'selected' : '' }}>Per jaar</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="pending" {{ $leaseContract->status === 'pending' ? 'selected' : '' }}>In afwachting</option>
                    <option value="active" {{ $leaseContract->status === 'active' ? 'selected' : '' }}>Actief</option>
                    <option value="terminated" {{ $leaseContract->status === 'terminated' ? 'selected' : '' }}>Beëindigd</option>
                    <option value="completed" {{ $leaseContract->status === 'completed' ? 'selected' : '' }}>Voltooid</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Bijwerken
            </button>
        </div>
    </form>
</div>
@endsection