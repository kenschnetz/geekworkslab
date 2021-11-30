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
        <script>
            (function() {
                window.onload = function(event) {
                    if (window.location.href.indexOf('page_y') !== -1) {
                        var match = window.location.href.split('?')[1].match(/\d+$/);
                        var page_y = match[0];
                        window.scrollTop(page_y);
                    }
                }

                window.onpageshow = function(event) {
                    if (event.persisted) {
                        // window.location.reload();

                        var page_y = $( document ).scrollTop();
                        window.location.replace = window.location.href + '?page_y=' + page_y;
                    }
                };
            })();
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100" style="margin-bottom: -48px !important;">
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
        @livewireScripts
        <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    </body>
</html>
