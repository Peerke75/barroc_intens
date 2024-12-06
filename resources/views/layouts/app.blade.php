<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<header>
	@include('components.nav-menu')
</header>

<body>
	@yield('content')
	@vite('resources/js/calendar.js')

</body>
<footer>
	@include('components.footer')
</footer>

</html>