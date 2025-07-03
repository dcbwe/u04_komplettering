<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'npmdb') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/public/favicon.svg') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>
<body class="bg-zinc-900 text-gray-900 font-sans">

    @include('layouts.navigation')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    @include('layouts.footer')

</body>
</html>
