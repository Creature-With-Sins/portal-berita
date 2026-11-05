<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KAMJA Portal') }} - Masuk & Registrasi</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-gradient-to-b from-[#0b0146] via-[#100363] to-slate-900 min-h-screen flex flex-col justify-between selection:bg-[#ff0000] selection:text-white relative overflow-x-hidden">

    <!-- Decorative Glow Orbs -->
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-[#ff0000]/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Mini Top Navigation -->
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between relative z-10">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="p-1.5 bg-white rounded-xl shadow-md group-hover:scale-105 transition">
                <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-8 w-auto" alt="Logo KAMJA">
            </div>
            <span class="font-extrabold text-xl text-white tracking-tight">
                KAMJA <span class="text-[#ff0000]">PORTAL</span>
            </span>
        </a>

        <a href="{{ route('home') }}" class="text-xs sm:text-sm font-semibold text-slate-300 hover:text-white flex items-center gap-1.5 transition">
            &larr; <span class="hidden sm:inline">Kembali ke</span> Beranda
        </a>
    </div>

    <!-- Center Card Area -->
    <div class="flex-1 flex flex-col justify-center items-center px-4 py-8 relative z-10 w-full">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-7 sm:p-9 border border-white/20 relative overflow-hidden">
            <!-- Top Red Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#ff0000]"></div>

            {{ $slot }}
        </div>
    </div>

    <!-- Footer Simple -->
    <div class="py-6 text-center text-xs text-slate-400 relative z-10 border-t border-white/10">
        &copy; {{ date('Y') }} KAMJA Portal • Akses Penulis & Kontributor
    </div>

</body>

</html>
