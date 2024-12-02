<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<header>
  @include('components.nav-menu')
</header>

<body>
  @yield('content')
  <script src="script.js"></script>

</body>
<footer>
  @include('components.footer')
</footer>
</html>