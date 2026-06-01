<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Doyan Frozen & Grill') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-orange-50 relative overflow-x-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-gradient-to-br from-orange-400 to-red-500 rounded-full blur-[100px] opacity-20 -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-gradient-to-br from-red-500 to-orange-400 rounded-full blur-[100px] opacity-20 -z-10"></div>

    <div class="min-h-screen flex flex-col justify-center items-center p-4">
        
        <div class="mb-8 text-center">
            <a href="/" class="inline-flex items-center gap-3 group">
                <x-application-logo class="w-16 h-auto group-hover:scale-105 transition-transform duration-300 drop-shadow-md" />
                <div class="text-left">
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight leading-none group-hover:text-orange-600 transition-colors">Doyan Grill</h1>
                    <p class="text-sm font-medium text-orange-500 uppercase tracking-widest">Frozen & Grill</p>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-white p-8 sm:p-10 shadow-2xl shadow-orange-500/10 rounded-[2rem] border border-orange-100 relative overflow-hidden">
            <!-- Decorative accent line -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-500 to-red-500"></div>
            
            {{ $slot }}
        </div>
        
        <p class="mt-8 text-sm text-gray-500 font-medium">
            &copy; {{ date('Y') }} Doyan Frozen & Grill. All rights reserved.
        </p>
    </div>
</body>
</html>
