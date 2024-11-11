@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Informatie</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">{{ $product->name }} - Product Informatie</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Linkerkolom: Product Details -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <img src="https://via.placeholder.com/500" alt="{{ $product->name }}" class="w-full h-64 object-cover mb-4">
                <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>
                <p class="text-lg font-bold text-gray-800 mb-2">Prijs: €{{ number_format($product->price, 2) }}</p>
                <p class="text-gray-600">Productcategorie: {{ $product->product_category_id }}</p>
                <a href="{{ route('products.buy', $product->id) }}"
                    class="block text-center py-2 px-4 mt-4 rounded transition"
                    style="background-color:#fdd716; color:#000000;">
                    Bestellen
                 </a>
            </div>

            <!-- Rechterkolom: Productomschrijving -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Productomschrijving</h3>
                <p class="text-gray-700 mb-4">
                    {{ $product->description ?? 'Deze omschrijving is tijdelijk niet beschikbaar. Dit product biedt geweldige prestaties en betrouwbaarheid. Met een strak ontwerp en eenvoudige bediening is het een uitstekende keuze voor dagelijks gebruik.' }}
                </p>
                <p class="text-gray-700 mb-4">
                    Onze producten zijn ontworpen met oog voor kwaliteit en duurzaamheid. Dit model biedt hoge efficiëntie en betrouwbaarheid, ideaal voor elke setting. Ontdek de toegevoegde waarde die dit product kan bieden in jouw dagelijks leven!
                </p>
                <p class="text-gray-700 mb-4">
                    Dit product is vervaardigd uit hoogwaardige materialen en voldoet aan de strengste normen. We streven ernaar om jou de beste ervaring te bieden, met een product dat zowel functioneel als stijlvol is.
                </p>
            </div>
        </div>
    </div>

</body>
</html>

@endsection
