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
        <a href="#" style="background-color:#fdd716 ;color:#000000;" class="text-white py-2 px-4 rounded  transition">Product Create</a>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
          </svg>

        <h1 class="text-3xl font-bold text-center mb-8">Product Overzicht</h1>
        <!-- Grid met 4 kolommen op grote schermen -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Product 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat A</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€99,99</p>
                    </div>
                    <a href="#" style="background-color:#000000 ;color:#fdd716;" class="block text-center py-2  px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat B</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€149,99</p>
                    </div>
                    <a href="#" style="background-color:#000000 ;color:#fdd716;" class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat C</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€199,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat D</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€249,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat E</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€299,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>                </div>
            </div>
            <!-- Product 6 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat F</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€349,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat G</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€399,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product Afbeelding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Koffiezetapparaat H</h2>
                    <div class="flex justify-between items-center mb-4">
                        <a class="text-gray-600" href="#">Info</a>
                        <p class="text-lg font-bold text-gray-800">€449,99</p>
                    </div>
                    <a href="#"  style="background-color:#000000 ;color:#fdd716;"class="block text-center py-2 px-4 rounded transition">Bekijk product</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>



@endsection
