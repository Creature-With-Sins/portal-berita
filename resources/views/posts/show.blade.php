<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ $post->title }} - KAMJA Portal</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-[#ff0000] selection:text-white min-h-screen flex flex-col justify-between pb-16 md:pb-0" x-data="{ copied: false }">

    <!-- Header / Navbar -->
    <header class="bg-[#0b0146] text-white sticky top-0 z-40 shadow-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <div class="p-1 sm:p-1.5 bg-white rounded-lg sm:rounded-xl shadow-md group-hover:scale-105 transition">
                    <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-7 sm:h-9 w-auto" alt="Logo KAMJA">
                </div>
                <div>
                    <span class="font-extrabold text-base sm:text-xl text-white tracking-tight flex items-center gap-1">
                        KAMJA <span class="text-[#ff0000]">PORTAL</span>
                    </span>
                    <p class="hidden xs:block text-[9px] sm:text-[10px] text-slate-300 tracking-wider uppercase font-medium">Berita & Aspirasi Warga</p>
                </div>
            </a>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('complaints.create') }}" 
                   class="bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm transition shadow-sm flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="hidden xs:inline">Form</span> Pengaduan
                </a>
                <a href="{{ route('home') }}" class="text-xs sm:text-sm font-semibold text-slate-200 hover:text-white bg-white/10 hover:bg-white/20 px-3 sm:px-3.5 py-2 rounded-xl transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="hidden sm:inline">Beranda</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Artikel -->
    <main class="max-w-4xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-12 flex-1 w-full">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-[11px] sm:text-xs text-slate-400 mb-4 sm:mb-6 overflow-hidden">
            <a href="{{ route('home') }}" class="hover:text-[#0b0146] transition shrink-0">Beranda</a>
            <span>/</span>
            <a href="{{ route('home', ['category' => $post->category->slug ?? '']) }}" class="hover:text-[#ff0000] font-semibold text-slate-600 shrink-0">
                {{ $post->category->name ?? 'Berita' }}
            </a>
            <span>/</span>
            <span class="text-slate-400 truncate">{{ $post->title }}</span>
        </nav>

        <!-- Container Artikel -->
        <article class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-slate-200 p-4 sm:p-10 md:p-12 overflow-hidden">
            
            <!-- Category Badge -->
            <div class="mb-3 sm:mb-4">
                <a href="{{ route('home', ['category' => $post->category->slug ?? '']) }}" 
                   class="inline-block bg-[#ff0000] text-white text-[10px] sm:text-xs font-extrabold uppercase px-2.5 sm:px-3 py-1 rounded-lg tracking-wider shadow-sm hover:bg-[#d90000] transition">
                    {{ $post->category->name ?? 'Umum' }}
                </a>
            </div>

            <!-- Judul Berita -->
            <h1 class="text-xl sm:text-3xl md:text-4xl font-extrabold text-[#0b0146] tracking-tight leading-snug sm:leading-tight mb-3 sm:mb-4">
                {{ $post->title }}
            </h1>

            <!-- Meta Info Penulis & Tanggal -->
            <div class="flex flex-col xs:flex-row xs:items-center justify-between gap-3 py-3 sm:py-4 mb-6 sm:mb-8 border-y border-slate-100 text-xs sm:text-sm text-slate-500">
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#0b0146] text-white font-bold flex items-center justify-center text-xs sm:text-sm shadow-sm shrink-0">
                        {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 text-xs sm:text-sm">{{ $post->author->name ?? 'Redaksi' }}</div>
                        <div class="text-[10px] sm:text-[11px] text-slate-400">Penulis Kontributor</div>
                    </div>
                </div>

                <div class="flex items-center gap-1.5 text-[11px] sm:text-xs text-slate-400">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $post->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->image || $post->image_url)
                <div class="mb-6 sm:mb-8 rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                    <img src="{{ asset('storage/' . ($post->image ?? $post->image_url)) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full max-h-[480px] object-cover">
                </div>
            @endif

            <!-- Isi Berita -->
            <div class="prose max-w-none text-slate-800 text-sm sm:text-base leading-relaxed space-y-4">
                {!! $post->content !!}
            </div>

            <!-- Share & Tag Section -->
            <div class="mt-8 sm:mt-12 pt-4 sm:pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-[11px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Bagikan:</span>
                    <!-- Tombol WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
                       target="_blank"
                       class="p-2 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition"
                       title="Bagikan ke WhatsApp">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                    </a>
                    <!-- Copy Link -->
                    <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2500)"
                            type="button"
                            class="px-2.5 sm:px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                        </svg>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Tautan'">Salin Tautan</span>
                    </button>
                </div>

                <a href="{{ route('home') }}" class="text-xs font-bold text-[#0b0146] hover:text-[#ff0000] transition flex items-center gap-1">
                    <span>&larr; Lihat Berita Lainnya</span>
                </a>
            </div>

        </article>

    </main>

    <!-- Footer Simple -->
    <footer class="bg-[#0b0146] text-slate-400 py-6 border-t-2 border-[#ff0000] text-xs text-center pb-20 md:pb-6">
        <p>&copy; {{ date('Y') }} KAMJA Portal • Hak Cipta Dilindungi</p>
    </footer>

    <!-- MOBILE BOTTOM APP BAR (Fixed di HP) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0b0146]/95 backdrop-blur-md border-t border-white/10 px-2 py-1.5 shadow-2xl">
        <div class="grid grid-cols-4 items-center justify-around text-center">
            
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-[10px] font-semibold">Beranda</span>
            </a>

            <a href="{{ route('complaints.create') }}" class="flex flex-col items-center justify-center -mt-5 group">
                <div class="w-12 h-12 rounded-full bg-[#ff0000] text-white flex items-center justify-center shadow-lg shadow-red-600/50 border-4 border-[#0b0146] group-active:scale-95 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-white mt-0.5">Lapor</span>
            </a>

            <a href="{{ route('complaints.track') }}" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-[10px] font-semibold">Lacak</span>
            </a>

            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="text-[10px] font-semibold">Berita Lain</span>
            </a>

        </div>
    </nav>

</body>

</html>
