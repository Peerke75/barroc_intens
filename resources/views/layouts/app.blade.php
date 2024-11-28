<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">   
	<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<header>
	@include('components.nav-menu')
</header>

<body>
	@yield('content')
	<script src="script.js"></script>
	@vite('resources/js/calendar.js')

</body>
<footer>
	@include('components.footer')
</footer>

</html>