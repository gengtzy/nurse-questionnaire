<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jaga Perawat UBK 2') }} - RSUD Welas Asih</title>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full bg-[#f1f5f4] text-[#132628] font-sans antialiased selection:bg-[#0b6b63] selection:text-white">
        <div class="min-h-screen flex flex-col justify-center py-10 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </body>
</html>
