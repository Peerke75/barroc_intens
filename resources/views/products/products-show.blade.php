@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="nl">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Zoeken</title>

        <!-- Tailwind CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100">

        <div class="container mx-auto px-4 py-8">

            <!-- Zoekbalk met een maximale breedte -->
            <div class="relative mb-6 max-w-md mx-auto">
                <input type="text" id="product-search" placeholder="Zoek product..."
                    class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    style="background-color: #ffffff; color: #000;">

                <!-- Suggesties container -->
                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                    <!-- Suggesties worden hier geladen -->
                </ul>
            </div>

            <!-- Create Product Button -->
            <div class="mb-8 text-left">
                <a href="{{ route('products.create') }}" style="background-color:#fdd716 ;color:#000000;"
                    class="text-white py-2 px-4 rounded transition hover:bg-yellow-400">
                    Product Create
                </a>
            </div>

            <h1 class="text-3xl font-bold text-center mb-8">Product Overzicht</h1>
            <!-- Grid met 4 kolommen op grote schermen -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="https://via.placeholder.com/300" alt="Product Afbeelding"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <div class="flex justify-between items-center mb-4">
                                <p class="text-lg font-bold text-gray-800">€{{ number_format($product->price, 2) }}</p>
                            </div>
                            <a href="{{ route('products.info', $product->id) }}" style="background-color:#000000 ;color:#fdd716;"
                                class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                        </div>
                    </div>
                @endforeach
                @if (session('success'))
                    <div
                        class="p-4 rounded mb-4 text-center
                            @if (strpos(session('success'), 'aangemaakt') !== false) bg-green-500 text-white  <!-- Groen voor create -->
                            @elseif(strpos(session('success'), 'bewerkt') !== false)
                                bg-gray-500 text-white  <!-- Grijs voor edit -->
                            @elseif(strpos(session('success'), 'verwijderd') !== false)
                                bg-red-500 text-white  <!-- Rood voor delete --> @endif">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('product-search');
                    const resultsContainer = document.getElementById('search-results');

                    searchInput.addEventListener('input', function() {
                        const query = searchInput.value;

                        if (query.length >= 2) {
                            fetch(`/products/search?query=${query}`)
                                .then(response => response.json())
                                .then(data => {
                                    resultsContainer.innerHTML = ''; // Leeg de vorige resultaten

                                    if (data.length > 0) {
                                        resultsContainer.classList.remove('hidden');
                                        data.forEach(product => {
                                            const li = document.createElement('li');
                                            li.classList.add('p-3', 'hover:bg-yellow-200',
                                                'cursor-pointer', 'text-gray-800', 'border-b',
                                                'border-gray-200');
                                            li.innerHTML =
                                                `<span class="font-semibold">${product.name}</span> - €${parseFloat(product.price).toFixed(2)}`;

                                            li.addEventListener('click', () => {
                                                window.location.href =
                                                    `/products/${product.id}/info`;
                                            });

                                            resultsContainer.appendChild(li);
                                        });
                                    } else {
                                        resultsContainer.classList.add('hidden');
                                    }
                                });
                        } else {
                            resultsContainer.classList.add('hidden');
                        }
                    });

                    // Verberg resultaten wanneer er buiten het zoekveld wordt geklikt
                    document.addEventListener('click', function(event) {
                        if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                            resultsContainer.classList.add('hidden');
                        }
                    });
                });
            </script>
    </body>

    </html>
@endsection
