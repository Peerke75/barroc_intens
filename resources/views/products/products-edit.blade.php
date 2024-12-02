@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Bewerk Product: {{ $product->name }}</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Product Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Prijs</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="w-full p-2 border border-gray-300 rounded" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="product_category_id" class="block text-gray-700 font-medium">Categorie</label>
                <select name="product_category_id" id="product_category_id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Selecteer een categorie</option>
                    @foreach(\App\Models\ProductCategory::all() as $category)
                        <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="storage_id" class="block text-gray-700 font-medium">Opslaglocatie</label>
                <select name="storage_id" id="storage_id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Selecteer opslaglocatie</option>
                    @foreach(\App\Models\Storage::all() as $storage)
                        <option value="{{ $storage->id }}" {{ $product->storage_id == $storage->id ? 'selected' : '' }}>{{ $storage->product_names }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Flex container voor beide knoppen -->
            <div class="flex space-x-2">
                <!-- Bewerk button -->
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Product Bijwerken</button>
        </form>

                <!-- Verwijder button in een aparte form -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded">Verwijderen</button>
                </form>
            </div>
    </div>
@endsection