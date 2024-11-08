<nav class="bg-black p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-4">
            <!-- Logo -->
            <a href="/" class="text-white font-bold text-xl">barroc_intens</a>

            <a href="{{ route ('products') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Voorraad</a>
            <a href="{{ route ('machines') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Apparaten</a>
            <a href="{{ route ('customers') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Klanten</a>
        </div>

        <div class="flex space-x-4">
        @if (Auth::check())
            <a href="{{ route('logout') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
        @endif

        </div>
    </div>
</nav>
