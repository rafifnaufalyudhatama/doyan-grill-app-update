<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            html { scroll-behavior: smooth; }
            .animate-delay-100 { animation-delay: 100ms; }
            .animate-delay-200 { animation-delay: 200ms; }
            .animate-delay-300 { animation-delay: 300ms; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <!-- Custom Premium Navbar -->
            <nav class="navbar animate-blur-in">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ asset('images/logo.png') }}" alt="Doyan Frozen & Grill Logo" class="h-10 w-auto object-contain drop-shadow-sm">
                    <span>Doyan Frozen & Grill</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a>
                    @auth
                        <a href="{{ route('recommendation.index') }}" class="hover:text-orange-500 transition-colors">Rekomendasi</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="py-1.5 px-4 rounded-full border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-all text-sm font-bold flex items-center gap-2"><i class="fas fa-gauge-high"></i> Panel Admin</a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('cart.index') }}" class="relative text-gray-800 hover:text-orange-600 transition-all text-xl">
                        <i class="fas fa-shopping-basket"></i>
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full font-bold ring-2 ring-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-sm text-gray-500">Hi, {{ explode(' ', Auth::user()->name)[0] }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-orange-600 hover:text-orange-700 font-bold text-sm transition-colors">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline py-2 px-5 rounded-lg border-2 hover:border-orange-500 transition-all">Login</a>
                    @endauth
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm" style="border-bottom: 1px solid #EEE;">
                    <div class="container" style="padding: 1.5rem 2rem;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="container">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </body>
</html>
