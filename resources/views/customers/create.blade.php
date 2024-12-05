@extends('layouts.app')
<title>Barroc intens | Klant aanmaken</title>
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Voeg een Nieuwe Klant Toe</h2>

    <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="contract_id" class="block text-sm font-semibold text-gray-700">Contract ID</label>
            <input type="number" name="contract_id" id="contract_id" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Contract ID">
            @error('contract_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contact_persons_id" class="block text-sm font-semibold text-gray-700">Contactpersoon ID</label>
            <input type="number" name="contact_persons_id" id="contact_persons_id" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Contactpersoon ID">
            @error('contact_persons_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="company_name" class="block text-sm font-semibold text-gray-700">Bedrijfsnaam</label>
            <input type="text" name="company_name" id="company_name" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Bedrijfsnaam">
            @error('company_name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Naam</label>
            <input type="text" name="name" id="name" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Naam">
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="mail" class="block text-sm font-semibold text-gray-700">E-mail</label>
            <input type="email" name="mail" id="mail" required
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="E-mail">
            @error('mail')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="BKR_check" class="block text-sm font-semibold text-gray-700">BKR-check</label>
            <select name="BKR_check" id="BKR_check"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="1">Ja</option>
                <option value="0">Nee</option>
            </select>
            @error('BKR_check')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="order_status" class="block text-sm font-semibold text-gray-700">Order Status</label>
            <input type="text" name="order_status" id="order_status"
                   class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Order Status">
            @error('order_status')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition-colors duration-200 text-lg font-semibold">
            Opslaan
        </button>
    </form>
</div>
@endsection
