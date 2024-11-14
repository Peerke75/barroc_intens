@extends('layouts.app')
<title>Barroc intens | Klant aanmaken</title>
@section('content')
<div class="max-w-md mx-auto bg-white p-8 mt-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Voeg een nieuwe klant toe</h2>

    <!-- Formulier voor klantinformatie -->
    <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
        @csrf <!-- Laravel CSRF-token voor veiligheid -->

        <!-- Contract ID -->
        <div>
            <label for="contract_id" class="block text-sm font-medium text-gray-700">Contract ID</label>
            <input type="number" name="contract_id" id="contract_id" required class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Contract ID">
            @error('contract_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contact Person ID -->
        <div>
            <label for="contact_persons_id" class="block text-sm font-medium text-gray-700">Contactpersoon ID</label>
            <input type="number" name="contact_persons_id" id="contact_persons_id" required class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Contactpersoon ID">
            @error('contact_persons_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bedrijfsnaam -->
        <div>
            <label for="company_name" class="block text-sm font-medium text-gray-700">Bedrijfsnaam</label>
            <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Bedrijfsnaam">
            @error('company_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Naam -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
            <input type="text" name="name" id="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Naam">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- E-mail -->
        <div>
            <label for="mail" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="mail" id="mail" required class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="E-mail">
            @error('mail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- BKR-check -->
        <div>
            <label for="BKR_check" class="block text-sm font-medium text-gray-700">BKR-check</label>
            <select name="BKR_check" id="BKR_check" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                <option value="1">Ja</option>
                <option value="0">Nee</option>
            </select>
            @error('BKR_check')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Order Status -->
        <div>
            <label for="order_status" class="block text-sm font-medium text-gray-700">Order Status</label>
            <input type="text" name="order_status" id="order_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" placeholder="Order Status">
            @error('order_status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Opslaan knop -->
        <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-200">
            Opslaan
        </button>
    </form>
</div>
@endsection
