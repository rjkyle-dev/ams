<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <fieldset class="border-4 rounded-md border-yellow-400 min-h-dvh m-2 bg-gray-200 p-2">
        <legend
            class="text-center text-3xl text-yellow-400 bg-violet-700 font-extrabold border-2 py-2 px-8 rounded-3xl ">
            Attendance Management System</legend>

        <img src="{{ asset('images/logos/fox.png') }}" alt=""
            class="max-h-[100px] fixed z-40 opacity-25 bottom-0 hover:opacity-100 transition-opacity duration-100">

        @if ($header)
            {{ $header }}
        @endif

        <main class="">
            {{ $slot }}
        </main>
    </fieldset>

</body>

</html>
