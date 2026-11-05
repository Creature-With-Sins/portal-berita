<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Berhasil Terkirim - KAMJA Portal</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col justify-between" x-data="{ copied: false }">

    <!-- Header / Navbar Sederhana -->
    <header class="bg-[#0b0146] text-white shadow-md border-b border-white/10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="p-1.5 bg-white rounded-xl shadow-md">
                    <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-9 w-auto" alt="Logo KAMJA">
                </div>
                <span class="font-extrabold text-xl text-white tracking-tight">
                    KAMJA <span class="text-[#ff0000]">PORTAL</span>
                </span>
            </a>

            <a href="{{ route('home') }}" class="text-xs sm:text-sm font-bold bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl transition">
                &larr; Beranda
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-2xl mx-auto px-4 py-12 flex-1 w-full flex items-center justify-center">
        
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-8 sm:p-10 text-center w-full relative overflow-hidden">
            <!-- Top Red Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#ff0000]"></div>

            <!-- Ikon Sukses -->
            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm ring-8 ring-emerald-50/50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0b0146] mb-2 tracking-tight">
                Pengaduan Berhasil Dikirim!
            </h1>
            <p class="text-slate-600 text-sm mb-6 leading-relaxed">
                Terima kasih atas aspirasi dan laporan yang Anda sampaikan. Laporan Anda telah tercatat di sistem kami dan akan segera ditinjau oleh pihak terkait.
            </p>

            <!-- Box Nomor Tiket -->
            @if($ticket)
                <div class="bg-slate-50 border-2 border-dashed border-[#0b0146]/20 rounded-2xl p-6 mb-8 text-center">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                        Nomor Tiket Pengaduan Anda
                    </span>
                    <div class="text-2xl sm:text-3xl font-extrabold text-[#0b0146] tracking-wider font-mono my-2 select-all" id="ticket-text">
                        {{ $ticket }}
                    </div>
                    <p class="text-xs text-slate-500 mb-4">
                        Simpan nomor tiket ini untuk mengecek status dan jawaban pengaduan Anda sewaktu-waktu.
                    </p>

                    <button @click="navigator.clipboard.writeText('{{ $ticket }}'); copied = true; setTimeout(() => copied = false, 2500)"
                            type="button" 
                            class="inline-flex items-center gap-2 bg-[#0b0146] hover:bg-[#14076e] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                        </svg>
                        <span x-text="copied ? '✓ Berhasil Disalin!' : 'Salin Nomor Tiket'">Salin Nomor Tiket</span>
                    </button>
                </div>
            @endif

            <!-- Rincian Singkat -->
            @if($complaint)
                <div class="bg-slate-50 rounded-2xl p-4 text-left text-xs space-y-2 mb-8 border border-slate-100">
                    <div class="flex justify-between py-1 border-b border-slate-200">
                        <span class="text-slate-400">Nama Pelapor:</span>
                        <span class="font-bold text-slate-700">{{ $complaint->name }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200">
                        <span class="text-slate-400">Kategori:</span>
                        <span class="font-bold text-[#ff0000]">{{ $complaint->category }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200">
                        <span class="text-slate-400">Judul Pengaduan:</span>
                        <span class="font-bold text-slate-800 line-clamp-1">{{ $complaint->title }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-400">Waktu Kirim:</span>
                        <span class="font-medium text-slate-600">{{ $complaint->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
            @endif

            <!-- Tombol Navigasi Lanjutan -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('complaints.track', ['ticket' => $ticket]) }}" 
                   class="w-full sm:w-auto bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-6 py-3 rounded-xl shadow-md transition text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Lacak Status Laporan Ini
                </a>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-6 py-3 rounded-xl transition text-sm">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-[#0b0146] text-slate-400 py-6 border-t-2 border-[#ff0000] text-xs text-center">
        <p>&copy; {{ date('Y') }} KAMJA Portal • Layanan Pengaduan Masyarakat</p>
    </footer>

</body>

</html>
