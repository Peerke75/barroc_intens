<footer class="bg-gray-800 text-gray-300 py-8">
    <div class="container mx-auto px-4 max-w-screen-xl">
        <div class="flex flex-wrap justify-between">
            <div class="w-full md:w-1/3 mb-6 md:mb-0 text-center md:text-left">
                <h5 class="text-gray-100 font-bold text-lg mb-2">Over Ons</h5>
                <p class="text-gray-400 text-sm">Wij zijn gespecialiseerd in koffie en staan klaar om al je vragen te beantwoorden.</p>
            </div>

            <div class="w-full md:w-1/3 mb-6 md:mb-0 text-center">
                <h5 class="text-gray-100 font-bold text-lg mb-2">Linkjes</h5>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#" class="hover:underline">Over Ons</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                    <li><a href="#" class="hover:underline">Diensten</a></li>
                </ul>
            </div>

            <div class="w-full md:w-1/3 text-center md:text-right">
                <h5 class="text-gray-100 font-bold text-lg mb-2">Bereik ons</h5>
                <p class="text-gray-400 text-sm">1234 Terheidenseweg 350, Breda</p>
                <p class="text-gray-400 text-sm">Email: info@example.com</p>
                <p class="text-gray-400 text-sm">Phone: (123) 456-7890</p>
            </div>
        </div>

        <div id="map" class="mt-8 h-64 md:h-96"></div>
        @vite('resources/js/leaflet.js')

        <div class="mt-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Barroc Intens. Alle rechten voorbehouden.
        </div>
    </div>
</footer>
