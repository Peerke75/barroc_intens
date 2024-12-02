@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-semibold mb-6">Customer Details for {{ $customer->name }}</h2>


    <form action="{{ route('invoice.store', $customer->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Description</label>
            <input type="text" name="description" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block font-medium">Price (€)</label>
            <input type="number" name="price" step="0.01" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block font-medium">Quantity</label>
            <input type="number" name="quantity" class="w-full p-2 border rounded" required>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Save Invoice
            </button>
            <a href="{{ route('customers.show', $customer->id) }}" class="ml-4 text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
