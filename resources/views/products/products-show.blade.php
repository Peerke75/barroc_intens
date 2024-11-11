@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Overzicht</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <a href="#" style="background-color:#fdd716 ;color:#000000;" class="text-white py-2 px-4 rounded transition">Product Create</a>

        <h1 class="text-3xl font-bold text-center mb-8">Product Overzicht</h1>
        <!-- Grid met 4 kolommen op grote schermen -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                        <div class="flex justify-between items-center mb-4">
                            <a class="text-gray-600" href="{{ route('products.info', $product->id) }}">Info</a>
                            <p class="text-lg font-bold text-gray-800">€{{ number_format($product->price, 2) }}</p>
                        </div>
                        <a href="#" style="background-color:#000000 ;color:#fdd716;" class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                    </div>
                </div>
            @endforeach
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

</body>
</html>

@endsection
