@extends('layouts.app')
<title>Product Zoeken</title>

@section('content')
    <body class="bg-gray-100">

        <div class="container mx-auto px-4 py-8">

            <div class="relative mb-6 max-w-md mx-auto">
                <input type="text" id="product-search" placeholder="Zoek product..."
                    class="w-full p-3 border border-gray-300 rounded shadow focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    style="background-color: #ffffff; color: #000;">

                <ul id="search-results"
                    class="absolute w-full border border-gray-300 rounded bg-white mt-1 hidden shadow-lg z-10">
                </ul>
            </div>

            <div class="mb-8 flex justify-between">
                <a href="{{ route('products.create') }}" style="background-color:#fdd716 ;color:#000000;"
                    class="text-white py-2 px-4 rounded transition hover:bg-yellow-400">
                    Product Create
                </a>
            </div>

            <h1 class="text-3xl font-bold text-center mb-8">Product Overzicht</h1>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <strong class="font-bold">Succes!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <span class="text-green-700">&times;</span>
                    </button>
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="https://picsum.photos/200/300" alt="Product Afbeelding" class="w-full h-48 object-cover"
                            loading="lazy">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <div class="flex justify-between items-center mb-4">
                                <p class="text-lg font-bold text-gray-800">€{{ number_format($product->price, 2) }}</p>
                            </div>
                            <a href="{{ route('products.info', $product->id) }}"
                                style="background-color:#000000 ;color:#fdd716;"
                                class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                        </div>
                    </div>
                @endforeach

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
                                    resultsContainer.innerHTML = '';

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

                    document.addEventListener('click', function(event) {
                        if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                            resultsContainer.classList.add('hidden');
                        }
                    });
                });
            </script>
    </body>
@endsection
