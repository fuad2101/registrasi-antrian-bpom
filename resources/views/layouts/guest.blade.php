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
        @wirekitStyles
        @livewireStyles()
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="flex flex-col text-center items-center font-bold text-2xl text-gray-800 dark:text-gray-200">
                <a href="/">
                    <x-application-logo height="100" width="100" class="fill-current text-gray-500" />
                </a>
                <p>Selamat datang di Aplikasi Registrasi Antrian Digital<br>
                Balai POM di Mamuju</p>
                <small class="text-gray-500 dark:text-gray-400 text-sm ">
                    <br>Silahkan melakukan login untuk  mendapatkan nomor antrian digital atau <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">registrasi</a> jika belum memiliki akun
                </small>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        @wirekitScripts
        @livewireScripts()
    </body>
</html>
