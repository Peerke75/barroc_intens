@extends('layouts.app')
<title> Barroc intens | storing aanmaken</title>
@section('content')
<div class="container">
    <h2 class="text-lg font-semibold mb-4">Nieuwe Storing Aanmaken</h2>

    <form action="{{ route('storingen.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- miss dropdown maken zodat je het product kan kiezen als je de verkeerde hebt aangeklikt geldt hetzelfde voor klanten -->
        <div>
            <label for="product_id" class="block text-sm font-medium">Product ID</label>
            <input type="text" name="product_id" id="product_id" class="w-full border px-3 py-2" required>
        </div>

        <div>
            <label for="customer_id" class="block text-sm font-medium">Customer ID</label>
            <input type="text" name="customer_id" id="customer_id" class="w-full border px-3 py-2" required>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium">Message</label>
            <textarea name="message" id="message" class="w-full border px-3 py-2" rows="3" required></textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <select name="status" id="status" class="w-full border px-3 py-2" required>
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>
            </select>
        </div>

        <div>
            <label for="date" class="block text-sm font-medium">Date</label>
            <input type="date" name="date" id="date" class="w-full border px-3 py-2" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Opslaan</button>
        </div>
    </form>
</div>
@endsection