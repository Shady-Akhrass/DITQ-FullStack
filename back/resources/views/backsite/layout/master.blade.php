<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->

    <title>
        @yield('title')
    </title>

    <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aref+Ruqaa+Ink&family=Cairo:wght@300;400;500;600;700&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600&family=Open+Sans:wght@300;400;500;700&family=Work+Sans:wght@300;400;500;600;700;800&display=swap');
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}" />
    
    
</head>

<body dir="rtl">

    <x-app-layout dir="rtl">
        <br>
        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 " dir="rtl">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" dir="rtl">
                @yield('content')
            </div>
        </div>
    </x-app-layout>


</body>


</html>
