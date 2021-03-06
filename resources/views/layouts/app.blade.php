<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        @livewireStyles
        <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased p-0 m-0">
        <div class="min-h-screen bg-gray-100" style="margin-bottom: -48px !important;">
            @auth
                @include('layouts.navigation')
                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
            <div class="bg-white text-center p-3 mt-5 underline text-blue-500 border-t border-gray-200 shadow">
                <a href="{{ route('terms') }}">Terms and Conditions</a>
            </div>
        @else
            {{ $slot }}
        @endauth
        @livewireScripts
        <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    </body>
</html>
