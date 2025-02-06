@extends('layouts.app')

@section('title', 'Barroc Intens | Storing Bewerken')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-brown-800 mb-6">Storing Bewerken</h1>

    <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6">
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('storingen.update', $malfunction->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Product -->
            <div>
                <label for="product_id" class="block text-sm font-semibold text-brown-700 mb-1">Product</label>
                <select name="product_id" id="product_id" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-brown-400 focus:border-brown-500" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $malfunction->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Klant -->
            <div>
                <label for="customer_id" class="block text-sm font-semibold text-brown-700 mb-1">Klant</label>
                <select name="customer_id" id="customer_id" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-brown-400 focus:border-brown-500" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $malfunction->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bericht -->
            <div>
                <label for="message" class="block text-sm font-semibold text-brown-700 mb-1">Bericht</label>
                <textarea name="message" id="message" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-brown-400 focus:border-brown-500" rows="4" required>{{ $malfunction->message }}</textarea>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-brown-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-brown-400 focus:border-brown-500" required>
                    <option value="Open" {{ $malfunction->status == 'Open' ? 'selected' : '' }}> Open</option>
                    <option value="Pending" {{ $malfunction->status == 'Pending' ? 'selected' : '' }}> In Behandeling</option>
                    <option value="Resolved" {{ $malfunction->status == 'Resolved' ? 'selected' : '' }}> Opgelost</option>
                    <option value="Closed" {{ $malfunction->status == 'Closed' ? 'selected' : '' }}> Gesloten</option>
                </select>
            </div>

            <!-- Datum -->
            <div>
                <label for="date" class="block text-sm font-semibold text-brown-700 mb-1">Datum</label>
                <input type="date" name="date" id="date" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-brown-400 focus:border-brown-500" value="{{ $malfunction->date }}" required>
            </div>

            <!-- Opslaan knop -->
            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-300 ease-in-out">
                     Bijwerken
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
