<footer class="bg-gray-100 text-white py-8">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/leaflet.js') }}"></script>
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full md:w-1/3 mb-6 md:mb-0">
                <h5 class="text-gray-800 font-bold text-lg mb-2">Over Ons</h5>
                <p class="text-gray-500 text-sm">Wij zijn een bedrijf die gespecialiseerd is in koffie. Bij ons kan je alles vragen over koffie</p>
            </div>
            <div class="w-full md:w-1/3 mb-6 md:mb-0">
                <h5 class="text-gray-800 font-bold text-lg mb-2">Linkjes</h5>
            </div>
            <div class="w-full md:w-1/3">
                <h5 class="text-gray-800 font-bold text-lg mb-2">Bereik ons</h5>
                <p class="text-gray-500 text-sm">1234 terheidenseweg 350 Breda</p>
                <p class="text-gray-500 text-sm">Email: info@example.com</p>
                <p class="text-gray-500 text-sm">Phone: (123) 456-7890</p>
            </div>
        </div>
        <div id="map" style="height: 400px;"></div>
        @vite('resources/js/leaflet.js')

        <div class="mt-8 text-center text-sm">
            &copy; @php date("Y") @endphp Barroc intens, Alle rechten gereserveerd.
        </div>
    </div>
</footer>