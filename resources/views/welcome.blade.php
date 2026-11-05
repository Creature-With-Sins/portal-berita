<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portal Berita & Layanan Masyarakat') }} - Informasi Terpercaya & Aspirasi Warga</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js & Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-[#ff0000] selection:text-white" x-data="{ searchOpen: false, mobileNavOpen: false }">

    <!-- Top Announcement Bar (Aksen Merah #ff0000) -->
    <div class="bg-[#ff0000] text-white text-xs font-semibold py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 bg-[#0b0146] text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sorotan
                </span>
                <span class="truncate">Layanan Pengaduan & Aspirasi Masyarakat kini terbuka online tanpa perlu registrasi akun!</span>
            </div>
            <div class="flex items-center gap-4 text-[11px] text-white/90 shrink-0">
                <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                <span class="hidden md:inline">•</span>
                <a href="{{ route('complaints.track') }}" class="underline hover:text-white transition">Cek Status Pengaduan</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (Dominan Navy #0b0146) -->
    <header class="bg-[#0b0146] text-white sticky top-0 z-40 shadow-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Sisi Kiri: Brand & Logo -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="p-1.5 bg-white rounded-xl shadow-md group-hover:scale-105 transition transform">
                        <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-9 w-auto" alt="Logo KAMJA">
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-white flex items-center gap-1">
                            KAMJA <span class="text-[#ff0000]">PORTAL</span>
                        </span>
                        <p class="text-[10px] text-slate-300 tracking-wider uppercase font-medium">Berita & Pengaduan Warga</p>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-semibold {{ !request('category') && !request()->routeIs('complaints.*') ? 'text-white bg-white/10' : 'text-slate-200 hover:text-white hover:bg-white/5' }} transition">
                        Beranda
                    </a>
                    <a href="#berita-section" 
                       class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/5 transition">
                        Berita Terkini
                    </a>
                    <a href="{{ route('complaints.create') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/5 transition flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#ff0000]"></span>
                        Form Pengaduan
                    </a>
                    <a href="{{ route('complaints.track') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-200 hover:text-white hover:bg-white/5 transition">
                        Lacak Laporan
                    </a>
                </nav>
            </div>

            <!-- Sisi Kanan: Search & Actions -->
            <div class="flex items-center gap-3">
                <!-- Tombol Search -->
                <button @click="searchOpen = true"
                    type="button"
                    class="p-2.5 text-slate-200 hover:text-white hover:bg-white/10 rounded-xl transition flex items-center gap-2 text-sm"
                    title="Cari Berita">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="hidden lg:inline text-xs font-medium text-slate-300">Cari Berita...</span>
                </button>

                <!-- Tombol CTA Utama: Buat Pengaduan (Aksen Merah #ff0000) -->
                <a href="{{ route('complaints.create') }}" 
                   class="bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-red-900/30 flex items-center gap-2 group">
                    <svg class="w-4 h-4 group-hover:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="hidden sm:inline">Buat</span> Pengaduan
                </a>

                <!-- Auth Button / Dashboard -->
                <div class="h-6 w-px bg-white/20 hidden sm:block"></div>
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="border border-white/20 bg-white/10 hover:bg-white/20 text-white font-semibold px-4 py-2.5 rounded-xl text-xs sm:text-sm transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="text-slate-300 hover:text-white font-medium text-xs sm:text-sm px-2 py-2">
                        Masuk
                    </a>
                @endauth

                <!-- Hamburger Mobile -->
                <button @click="mobileNavOpen = !mobileNavOpen" class="md:hidden p-2 text-slate-200 hover:text-white rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileNavOpen" 
             x-transition 
             class="md:hidden bg-[#07002e] border-t border-white/10 px-4 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10">Beranda</a>
            <a href="#berita-section" @click="mobileNavOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-white/10">Berita Terkini</a>
            <a href="{{ route('complaints.create') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-[#ff0000] bg-red-500/10">Form Pengaduan Masyarakat</a>
            <a href="{{ route('complaints.track') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-white/10">Lacak Pengaduan</a>
            <div class="pt-3 border-t border-white/10 flex items-center justify-between">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full text-center bg-white/20 text-white font-bold py-2 rounded-lg text-sm">Masuk Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 text-sm font-medium">Masuk Penulis</a>
                    <a href="{{ route('register') }}" class="text-[#ff0000] text-sm font-bold">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- SEARCH MODAL POPUP -->
    <div x-show="searchOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">

        <div class="fixed inset-0 bg-[#0b0146]/70 backdrop-blur-sm" @click="searchOpen = false"></div>

        <div class="relative min-h-screen flex items-start justify-center p-4 pt-24">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-xl w-full p-6 overflow-hidden border border-slate-100 z-10"
                @click.away="searchOpen = false">

                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-[#0b0146] text-white flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Cari Berita & Informasi</h3>
                    </div>
                    <button @click="searchOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('home') }}" method="GET" class="space-y-4">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Ketik judul atau isi artikel..."
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition"
                            autofocus>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="searchOpen = false" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 bg-[#0b0146] hover:bg-[#14076e] text-white font-semibold rounded-xl text-sm transition shadow-md">
                            Cari Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- HERO SECTION: Civic Banner & Quick Access -->
    <section class="relative bg-gradient-to-b from-[#0b0146] via-[#10045f] to-slate-900 text-white overflow-hidden py-14 sm:py-20">
        <!-- Background Decorative Orbs -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#ff0000]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Sisi Kiri: Pesan Selamat Datang & Layanan Terpadu -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 text-xs font-semibold text-slate-200">
                        <span class="w-2 h-2 rounded-full bg-[#ff0000]"></span>
                        Portal Publikasi Berita & Pengaduan Warga
                    </div>
                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                        Informasi Terbuka, <br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-300 to-amber-200">Suara Warga Didengar.</span>
                    </h1>
                    <p class="text-slate-300 text-base sm:text-lg max-w-xl leading-relaxed">
                        Dapatkan berita terkini, terverifikasi, dan sampaikan aspirasi atau keluhan Anda langsung ke pengelola tanpa ribet membuat akun.
                    </p>

                    <!-- Tombol Aksi Cepat -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
                        <a href="{{ route('complaints.create') }}" 
                           class="bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-6 py-3.5 rounded-xl shadow-lg shadow-red-600/30 transition-all duration-200 hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Ajukan Pengaduan (Tanpa Akun)
                        </a>
                        <a href="{{ route('complaints.track') }}" 
                           class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-6 py-3.5 rounded-xl transition backdrop-blur-sm flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Lacak Tiket Laporan
                        </a>
                    </div>
                </div>

                <!-- Sisi Kanan: Mini Card Layanan Pengaduan Cepat -->
                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 sm:p-7 border border-white/20 shadow-2xl relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#ff0000]"></div>
                                <h3 class="font-bold text-white text-base">Alur Pengaduan Cepat</h3>
                            </div>
                            <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/20 px-2.5 py-1 rounded-full border border-emerald-400/30">
                                100% Bebas Akses
                            </span>
                        </div>

                        <div class="space-y-3.5 text-xs">
                            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-2xl border border-white/10">
                                <div class="w-7 h-7 rounded-xl bg-[#ff0000] text-white flex items-center justify-center font-bold text-xs shrink-0">1</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Isi Formulir Standar</h4>
                                    <p class="text-slate-300 mt-0.5">Sampaikan keluhan, sertakan lokasi, serta foto bukti jika ada.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-2xl border border-white/10">
                                <div class="w-7 h-7 rounded-xl bg-[#0b0146] border border-white/20 text-white flex items-center justify-center font-bold text-xs shrink-0">2</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Terima Kode Tiket</h4>
                                    <p class="text-slate-300 mt-0.5">Dapatkan kode tiket unik resmi untuk memantau status secara langsung.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white/5 p-3 rounded-2xl border border-white/10">
                                <div class="w-7 h-7 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shrink-0">3</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Tindak Lanjut & Respon</h4>
                                    <p class="text-slate-300 mt-0.5">Tim admin meninjau pengaduan dan memberikan respon tindak lanjut.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-white/15 text-center">
                            <a href="{{ route('complaints.create') }}" class="text-xs font-bold text-red-400 hover:text-red-300 inline-flex items-center gap-1 group">
                                Buka Formulir Pengajuan Sekarang 
                                <span class="group-hover:translate-x-1 transition">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MAIN CONTENT AREA -->
    <main id="berita-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Section Berita -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-slate-200 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2.5 h-6 bg-[#ff0000] rounded-sm"></span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0b0146] tracking-tight">Kabar & Publikasi Terkini</h2>
                </div>
                <p class="text-slate-500 text-sm">Informasi aktual, terpercaya, dan penting untuk Anda.</p>
            </div>

            <!-- Filter Kategori Pill Buttons -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('home') }}" 
                       class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition shadow-sm {{ !request('category') ? 'bg-[#0b0146] text-white ring-2 ring-[#0b0146]/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('home', array_merge(request()->query(), ['category' => $cat->slug])) }}" 
                           class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition shadow-sm {{ request('category') == $cat->slug ? 'bg-[#ff0000] text-white ring-2 ring-red-500/20' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        @if(request('search'))
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-2xl flex items-center justify-between text-sm text-[#0b0146]">
                <span>Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                <a href="{{ route('home') }}" class="text-xs text-[#ff0000] font-bold hover:underline">Reset Pencarian</a>
            </div>
        @endif

        @if(isset($posts) && $posts->count() > 0)
            <!-- Grid Layout Berita Modern -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- SISI KIRI (BERITA UTAMA / HERO POST) - 7 Kolom -->
                @php $featuredPost = $posts->first(); @endphp
                <div class="lg:col-span-7">
                    <article class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover:border-slate-300 transition-all duration-300 flex flex-col group h-full">
                        
                        <!-- Gambar Berita Utama -->
                        <div class="w-full h-72 sm:h-96 bg-slate-100 relative overflow-hidden shrink-0">
                            @if($featuredPost->image || $featuredPost->image_url)
                                <img src="{{ asset('storage/' . ($featuredPost->image ?? $featuredPost->image_url)) }}" 
                                     alt="{{ $featuredPost->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-[#0b0146] to-[#1e0a8a] flex items-center justify-center p-8 text-center text-white font-extrabold text-2xl">
                                    {{ $featuredPost->title }}
                                </div>
                            @endif

                            <!-- Floating Badge Kategori -->
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="bg-[#ff0000] text-white text-xs font-extrabold px-3 py-1.5 rounded-lg shadow-md uppercase tracking-wider">
                                    {{ $featuredPost->category->name ?? 'Umum' }}
                                </span>
                                <span class="bg-[#0b0146]/90 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                                    Utama
                                </span>
                            </div>
                        </div>

                        <!-- Konten Berita Utama -->
                        <div class="p-6 sm:p-8 flex flex-col justify-between flex-1">
                            <div>
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                                    <span class="flex items-center gap-1 font-semibold text-slate-600">
                                        <svg class="w-4 h-4 text-[#ff0000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $featuredPost->author->name ?? 'Redaksi' }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                </div>

                                <h3 class="text-2xl sm:text-3xl font-extrabold text-[#0b0146] group-hover:text-[#ff0000] transition-colors leading-snug mb-3">
                                    <a href="{{ route('posts.show', $featuredPost->slug) }}">
                                        {{ $featuredPost->title }}
                                    </a>
                                </h3>

                                <p class="text-slate-600 text-sm sm:text-base leading-relaxed line-clamp-3 mb-6">
                                    {{ Str::limit(strip_tags($featuredPost->content), 180) }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('posts.show', $featuredPost->slug) }}" 
                                   class="text-[#0b0146] group-hover:text-[#ff0000] font-bold text-sm inline-flex items-center gap-1.5 transition">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                                <span class="text-xs text-slate-400">Estimasi baca: 3 mnt</span>
                            </div>
                        </div>

                    </article>
                </div>

                <!-- SISI KANAN (DAFTAR BERITA TERBARU LAINNYA) - 5 Kolom -->
                <div class="lg:col-span-5 space-y-4">
                    @forelse($posts->skip(1)->take(5) as $post)
                        <article class="bg-white rounded-2xl p-4 border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow-md transition-all duration-200 flex gap-4 group">
                            
                            <!-- Thumbnail Gambar -->
                            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-xl bg-slate-100 overflow-hidden shrink-0 relative">
                                @if($post->image || $post->image_url)
                                    <img src="{{ asset('storage/' . ($post->image ?? $post->image_url)) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-[#0b0146] text-white flex items-center justify-center p-2 text-center text-xs font-bold">
                                        {{ Str::limit($post->title, 20) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Info Berita -->
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="text-[11px] font-bold text-[#ff0000] uppercase tracking-wider">
                                            {{ $post->category->name ?? 'Berita' }}
                                        </span>
                                        <span class="text-[11px] text-slate-400">•</span>
                                        <span class="text-[11px] text-slate-400">{{ $post->created_at->format('d M Y') }}</span>
                                    </div>

                                    <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#ff0000] transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h4>

                                    <p class="text-slate-500 text-xs line-clamp-2 mt-1 leading-relaxed hidden sm:block">
                                        {{ Str::limit(strip_tags($post->content), 85) }}
                                    </p>
                                </div>

                                <div class="pt-2 flex items-center justify-between text-[11px] text-slate-400">
                                    <span>Oleh: <strong class="text-slate-700 font-semibold">{{ $post->author->name ?? 'Admin' }}</strong></span>
                                </div>
                            </div>

                        </article>
                    @empty
                        <div class="p-8 bg-white rounded-2xl border border-slate-200 text-center text-slate-500 text-sm">
                            Tidak ada artikel lainnya saat ini.
                        </div>
                    @endforelse
                </div>

            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-red-50 text-[#ff0000] flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Berita</h3>
                <p class="text-slate-500 text-sm mb-6">Artikel yang sesuai kriteria belum ditemukan atau belum diterbitkan.</p>
                <a href="{{ route('home') }}" class="inline-block bg-[#0b0146] text-white font-bold px-6 py-2.5 rounded-xl hover:bg-[#14076e] transition text-sm">
                    Lihat Semua Berita
                </a>
            </div>
        @endif

    </main>

    <!-- SECTION CALLOUT PENGADUAN MASYARAKAT (PROFESIONAL & MENARIK) -->
    <section class="bg-gradient-to-r from-[#0b0146] via-[#11016d] to-[#0b0146] text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ff0000_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl p-8 sm:p-12 shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8">
                
                <div class="max-w-2xl space-y-4 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#ff0000] text-white text-xs font-bold uppercase tracking-wider">
                        Layanan Bebas Registrasi
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                        Punya Masalah di Sekitar Anda? <br>
                        <span class="text-red-400">Laporkan Melalui Formulir Pengaduan.</span>
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Mulai dari kerusakan jalan, kebersihan lingkungan, pelayanan publik, hingga usulan sosial warga. Pengaduan Anda akan langsung dicatat ke sistem dan dapat dilacak nomor tiketnya secara transparan.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full lg:w-auto">
                    <a href="{{ route('complaints.create') }}" 
                       class="w-full sm:w-auto text-center bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-red-900/40 transition-all duration-200 hover:scale-105 text-sm sm:text-base">
                        Isi Form Pengaduan
                    </a>
                    <a href="{{ route('complaints.track') }}" 
                       class="w-full sm:w-auto text-center bg-white text-[#0b0146] hover:bg-slate-100 font-bold px-6 py-4 rounded-2xl shadow-lg transition text-sm sm:text-base">
                        Cek Status Laporan
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER PROFESIONAL (Navy #0b0146 & Red #ff0000 Top Accent) -->
    <footer class="bg-[#0b0146] text-slate-300 border-t-4 border-[#ff0000]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                
                <!-- Kolom 1: Brand Info -->
                <div class="space-y-4 md:col-span-2">
                    <div class="flex items-center gap-3">
                        <div class="p-1.5 bg-white rounded-xl shadow-md">
                            <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-8 w-auto" alt="Logo">
                        </div>
                        <span class="font-extrabold text-xl text-white tracking-tight">
                            KAMJA <span class="text-[#ff0000]">PORTAL</span>
                        </span>
                    </div>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-md">
                        Portal berita resmi dan kanal aspirasi pengaduan publik. Memberikan informasi terpercaya sekaligus memfasilitasi suara masyarakat secara transparan, akurat, dan akuntabel.
                    </p>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-[#ff0000] pl-2.5">
                        Navigasi
                    </h4>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Halaman Beranda</a></li>
                        <li><a href="#berita-section" class="hover:text-white transition">Berita Terbaru</a></li>
                        <li><a href="{{ route('complaints.create') }}" class="hover:text-white transition text-[#ff0000] font-semibold">Form Pengaduan Warga</a></li>
                        <li><a href="{{ route('complaints.track') }}" class="hover:text-white transition">Lacak Status Laporan</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan & Akun -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-[#ff0000] pl-2.5">
                        Redaksi & Penulis
                    </h4>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard Saya</a></li>
                            <li><a href="{{ route('posts.create') }}" class="hover:text-white transition">+ Buat Artikel Baru</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition">Pengaturan Akun</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Login Penulis / Kontributor</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition">Daftar Akun Penulis</a></li>
                        @endauth
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} KAMJA Portal. Seluruh hak cipta dilindungi undang-undang.</p>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-1.5 text-slate-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Layanan Online Aktif
                    </span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
