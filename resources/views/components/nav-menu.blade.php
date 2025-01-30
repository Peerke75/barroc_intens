<nav class="bg-black p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo / Branding -->
        <div class="flex space-x-4">
            <a href="{{ route('dashboard') }}" class="text-white font-bold text-xl">Barroc_Intens</a>
        </div>

        <!-- Mobile Hamburger Button (Visible on tablet and small screens) -->
        <button id="hamburger" class="block md:hidden text-white">
            ☰
        </button>


        <!-- Navigation Links (Hidden on small screens) -->
        <div class="flex space-x-4 md:flex hidden">
            <a href="{{ route('products') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Voorraad</a>
            <a href="{{ route('customers') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Klanten</a>
            <a href="{{ route('storingen.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Storingen</a>
            <a href="{{ route('sales.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Afspraken</a>
            <a href="{{ route('agenda') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Agenda</a>
            <a href="{{ route('proposals.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Offertes</a>
            <a href="{{ route('leasecontracts.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">leasecontracten</a>
        </div>

        <!-- Right Section (Login/Logout) -->
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

    <!-- Drawer (Initially hidden) -->
    <div id="mobile-nav-drawer" class="fixed inset-0 bg-black bg-opacity-90 z-50 transform -translate-x-full transition-all ease-in-out duration-300">
        <div class="flex justify-between items-center p-4">
            <button id="close-drawer" class="text-white">X</button>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="flex flex-col items-center space-y-4 mt-4">
            <a href="{{ route('products') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Voorraad</a>
            <a href="{{ route('customers') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Klanten</a>
            <a href="{{ route('storingen.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Storingen</a>
            <a href="{{ route('sales.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Afspraken</a>
            <a href="{{ route('agenda') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Agenda</a>
            <a href="{{ route('proposals.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Offertes</a>
            <a href="{{ route('leasecontracts.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">leasecontracten</a>
        </div>
    </div>
</nav>
