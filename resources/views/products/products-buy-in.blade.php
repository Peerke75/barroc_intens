@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling Bevestigen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Bestelling Bevestigen</h1>

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
            <h2 class="text-2xl font-semibold mb-4">{{ $product->name }}</h2>
            <img src="https://via.placeholder.com/300" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4">
            <p class="text-lg font-bold text-gray-800 mb-4">Prijs: €{{ number_format($product->price, 2) }}</p>

            <form action="{{ route('products.storeOrder', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <button type="submit"
                        class="block text-center py-2 px-4 rounded transition w-full"
                        style="background-color:#000000; color:#fdd716;">
                    Bestelling Bevestigen
                </button>
            </form>
        </div>
    </div>

</body>
</html>
@endsection
