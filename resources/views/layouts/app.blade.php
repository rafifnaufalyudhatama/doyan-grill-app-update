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
            <nav class="navbar animate-blur-in flex-nowrap w-full overflow-x-auto no-scrollbar gap-4 md:gap-8">
                
                <!-- Left: Brand -->
                <a href="{{ route('home') }}" class="navbar-brand flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Doyan Frozen & Grill Logo" class="h-10 w-auto object-contain drop-shadow-sm">
                    <span>Doyan Frozen & Grill</span>
                </a>

                <!-- Center: Nav Links -->
                <div class="nav-links flex items-center justify-center gap-4 md:gap-8 whitespace-nowrap">
                    <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors font-semibold text-gray-800">Home</a>
                    @auth
                        <a href="{{ route('recommendation.index') }}" class="hover:text-orange-500 transition-colors font-semibold text-gray-800">Rekomendasi</a>
                        <a href="{{ route('order.history') }}" class="hover:text-orange-500 transition-colors font-semibold text-gray-800">Riwayat Pesanan</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors font-semibold text-gray-800">Panel Admin</a>
                        @endif
                    @endauth
                </div>

                <!-- Right: Cart & Options -->
                <div class="flex items-center justify-end gap-4 md:gap-6 whitespace-nowrap flex-shrink-0">
                    <a href="{{ route('cart.index') }}" class="relative text-gray-800 hover:text-orange-600 transition-all text-xl mr-2">
                        <i class="fas fa-shopping-basket"></i>
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full font-bold ring-2 ring-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="font-medium text-sm text-gray-500">Hi, {{ explode(' ', Auth::user()->name)[0] }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 flex items-center">
                                @csrf
                                <button type="submit" class="text-orange-500 hover:text-orange-600 font-semibold text-sm transition-colors">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-orange-500 hover:text-orange-600 transition-all text-sm">Login</a>
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
