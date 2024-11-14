@extends('layouts.app')
<title> Barroc intens | storing aanpassen</title>

@section('content')
<div class="container px-3">
    <h2 class="text-lg font-semibold mb-4">Storing Bewerken</h2>

    <form action="{{ route('storingen.update', $malfunction->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="product_id" class="block text-sm font-medium">Product ID</label>
            <input type="text" name="product_id" id="product_id" class="w-full border px-3 py-2" value="{{ $malfunction->product_id }}" required>
        </div>

        <div>
            <label for="customer_id" class="block text-sm font-medium">Customer ID</label>
            <input type="text" name="customer_id" id="customer_id" class="w-full border px-3 py-2" value="{{ $malfunction->customer_id }}" required>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium">Message</label>
            <textarea name="message" id="message" class="w-full border px-3 py-2" rows="3" required>{{ $malfunction->message }}</textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <select name="status" id="status" class="w-full border px-3 py-2" required>
                <option value="Open" {{ $malfunction->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Closed" {{ $malfunction->status == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div>
            <label for="date" class="block text-sm font-medium">Date</label>
            <input type="date" name="date" id="date" class="w-full border px-3 py-2" value="{{ $malfunction->date }}" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Bijwerken</button>
        </div>
    </form>
</div>
@endsection