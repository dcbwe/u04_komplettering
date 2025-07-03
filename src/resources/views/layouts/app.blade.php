<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <title>{{ config('app.name', 'Non profitable movie database') }}</title>
        <!-- Scripts -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style>
        ::-webkit-scrollbar {
            width: 0.0em;
            height: 0em; 
        }
        ::-webkit-scrollbar-thumb {
            background-color: rgb(255, 255, 255);
            border: 0px solid rgb(247, 247, 151);
        }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col justify-between min-h-screen bg-zinc-950">
            @include('layouts.navigation')
            <main class="flex flex-col items-center flex-grow min-h-full gap-3">
                {{ $slot }}
            </main>
            @include('layouts.footer')
        </div>
    </body>
</html>
