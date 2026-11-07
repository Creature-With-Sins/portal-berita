<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Lacak Status Pengaduan - KAMJA Portal</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-[#ff0000] selection:text-white pb-16 md:pb-0">

    <!-- Header Sederhana -->
    <header class="bg-[#0b0146] text-white shadow-lg border-b border-white/10">
        <div class="max-w-5xl mx-auto px-3 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <div class="p-1 sm:p-1.5 bg-white rounded-lg sm:rounded-xl shadow-md group-hover:scale-105 transition">
                    <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-7 sm:h-9 w-auto" alt="Logo KAMJA">
                </div>
                <div>
                    <span class="font-extrabold text-base sm:text-xl text-white tracking-tight flex items-center gap-1">
                        KAMJA <span class="text-[#ff0000]">PORTAL</span>
                    </span>
                    <p class="hidden xs:block text-[9px] sm:text-[10px] text-slate-300 tracking-wider uppercase font-medium">Layanan Pengaduan Warga</p>
                </div>
            </a>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('complaints.create') }}" class="text-xs sm:text-sm font-bold bg-[#ff0000] hover:bg-[#d90000] text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-xl transition shadow-sm flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    <span class="hidden xs:inline">Buat</span> Laporan
                </a>
                <a href="{{ route('home') }}" class="text-xs sm:text-sm font-semibold bg-white/10 hover:bg-white/20 text-white px-2.5 sm:px-3.5 py-1.5 sm:py-2 rounded-xl transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="hidden sm:inline">Beranda</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10 flex-1 w-full">

        <!-- Title & Form Pencarian Tiket -->
        <div class="text-center max-w-xl mx-auto mb-6 sm:mb-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-[#ff0000] text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-2">
                Pencarian Mandiri
            </span>
            <h1 class="text-xl sm:text-3xl font-extrabold text-[#0b0146] tracking-tight">Lacak Status Pengaduan Warga</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1.5 sm:mt-2">
                Masukkan Nomor Tiket resmi yang Anda peroleh saat mengirim pengaduan.
            </p>
        </div>

        <!-- Input Box Pencarian Tiket -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-8 shadow-sm border border-slate-200 max-w-2xl mx-auto mb-6 sm:mb-8">
            <form action="{{ route('complaints.track') }}" method="GET" class="flex flex-col sm:flex-row gap-2.5 sm:gap-3">
                <div class="relative flex-1">
                    <input type="text" 
                           name="ticket" 
                           value="{{ request('ticket') }}"
                           placeholder="Contoh: PGD-20261027-XXXXX"
                           required
                           class="w-full pl-10 sm:pl-11 pr-4 py-2.5 sm:py-3.5 bg-slate-50 border border-slate-200 rounded-xl sm:rounded-2xl text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none font-mono font-bold tracking-wider">
                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit" 
                        class="bg-[#0b0146] hover:bg-[#14076e] text-white font-bold px-6 py-2.5 sm:py-3.5 rounded-xl sm:rounded-2xl transition shadow-md text-xs sm:text-sm shrink-0 flex items-center justify-center gap-2">
                    <span>Lacak Tiket</span>
                </button>
            </form>
        </div>

        <!-- Hasil Pencarian -->
        @if($ticket !== '')
            @if($complaint)
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-md border border-slate-200 overflow-hidden max-w-2xl mx-auto">
                    
                    <!-- Header Kartu Tiket -->
                    <div class="bg-[#0b0146] text-white p-4 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
                        <div>
                            <span class="text-[10px] sm:text-xs text-slate-300 uppercase tracking-wider block">Nomor Tiket</span>
                            <span class="text-lg sm:text-2xl font-extrabold font-mono tracking-wider text-white break-all">{{ $complaint->ticket_number }}</span>
                        </div>
                        <div>
                            @php $meta = $complaint->status_meta; @endphp
                            <span class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-3.5 py-1 sm:py-1.5 rounded-full text-xs font-extrabold border {{ $meta['bg'] }}">
                                <span class="w-2 h-2 rounded-full {{ $meta['dot'] }}"></span>
                                {{ $meta['label'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Progress Step Indicator -->
                    <div class="p-4 sm:p-8 border-b border-slate-100 bg-slate-50/50">
                        <div class="grid grid-cols-3 gap-2 text-center text-xs relative">
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-bold text-xs mb-1 {{ in_array($complaint->status, ['pending', 'diproses', 'selesai']) ? 'bg-[#0b0146] text-white ring-2 sm:ring-4 ring-blue-100' : 'bg-slate-200 text-slate-500' }}">
                                    1
                                </div>
                                <span class="font-bold text-slate-800 text-[11px] sm:text-xs">Diterima</span>
                                <span class="text-[9px] sm:text-[10px] text-slate-400">{{ $complaint->created_at->format('d/m/Y') }}</span>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-bold text-xs mb-1 {{ in_array($complaint->status, ['diproses', 'selesai']) ? 'bg-blue-600 text-white ring-2 sm:ring-4 ring-blue-100' : 'bg-slate-200 text-slate-500' }}">
                                    2
                                </div>
                                <span class="font-bold text-[11px] sm:text-xs {{ in_array($complaint->status, ['diproses', 'selesai']) ? 'text-blue-700' : 'text-slate-400' }}">Diproses</span>
                                <span class="text-[9px] sm:text-[10px] text-slate-400 hidden xs:inline">Verifikasi</span>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-bold text-xs mb-1 {{ $complaint->status === 'selesai' ? 'bg-emerald-600 text-white ring-2 sm:ring-4 ring-emerald-100' : ($complaint->status === 'ditolak' ? 'bg-rose-600 text-white' : 'bg-slate-200 text-slate-500') }}">
                                    {{ $complaint->status === 'ditolak' ? '✗' : '3' }}
                                </div>
                                <span class="font-bold text-[11px] sm:text-xs {{ $complaint->status === 'selesai' ? 'text-emerald-700' : ($complaint->status === 'ditolak' ? 'text-rose-700' : 'text-slate-400') }}">
                                    {{ $complaint->status === 'ditolak' ? 'Ditolak' : 'Selesai' }}
                                </span>
                                <span class="text-[9px] sm:text-[10px] text-slate-400 hidden xs:inline">Tindak Lanjut</span>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Isi Laporan -->
                    <div class="p-4 sm:p-8 space-y-4 sm:space-y-6">
                        
                        <!-- Tanggapan Admin Resmi (Jika ada) -->
                        @if($complaint->response)
                            <div class="p-4 sm:p-5 bg-emerald-50 border-2 border-emerald-200 rounded-xl sm:rounded-2xl">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 shrink-0"></span>
                                    <h4 class="font-bold text-xs sm:text-sm text-emerald-900">Tanggapan Resmi Petugas / Admin:</h4>
                                    @if($complaint->responded_at)
                                        <span class="text-[10px] sm:text-[11px] text-emerald-700 ml-auto shrink-0">{{ $complaint->responded_at->translatedFormat('d M Y') }}</span>
                                    @endif
                                </div>
                                <p class="text-xs sm:text-sm text-emerald-800 leading-relaxed whitespace-pre-line">{{ $complaint->response }}</p>
                            </div>
                        @else
                            <div class="p-3.5 sm:p-4 bg-amber-50 border border-amber-200 rounded-xl sm:rounded-2xl text-xs text-amber-800 flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Laporan Anda sedang dalam antrean pemeriksaan oleh tim verifikator kami.</span>
                            </div>
                        @endif

                        <!-- Informasi Pokok Laporan -->
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <span class="text-[10px] sm:text-xs font-bold text-[#ff0000] uppercase tracking-wider block mb-0.5 sm:mb-1">{{ $complaint->category }}</span>
                                <h3 class="text-base sm:text-xl font-bold text-slate-900">{{ $complaint->title }}</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3 text-xs bg-slate-50 p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-100">
                                <div>
                                    <span class="text-slate-400 block text-[10px] sm:text-xs">Nama Pelapor:</span>
                                    <span class="font-bold text-slate-700">{{ $complaint->name }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[10px] sm:text-xs">Lokasi:</span>
                                    <span class="font-medium text-slate-700">{{ $complaint->location ?? 'Tidak disertakan' }}</span>
                                </div>
                            </div>

                            <div>
                                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Rincian Laporan:</span>
                                <div class="bg-slate-50 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                    {{ $complaint->content }}
                                </div>
                            </div>

                            @if($complaint->attachment)
                                <div>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Lampiran Bukti:</span>
                                    <div class="rounded-xl sm:rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 p-2 max-w-sm">
                                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="block group relative">
                                            <img src="{{ asset('storage/' . $complaint->attachment) }}" alt="Lampiran" class="w-full h-40 sm:h-48 object-cover rounded-lg sm:rounded-xl group-hover:opacity-90 transition">
                                            <div class="text-center pt-2 text-xs font-bold text-[#0b0146] hover:underline">
                                                Lihat Gambar Penuh &rarr;
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            @else
                <!-- Pengaduan Tidak Ditemukan -->
                <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200 p-6 sm:p-10 text-center max-w-md mx-auto shadow-sm">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-1">Tiket Tidak Ditemukan</h3>
                    <p class="text-slate-500 text-xs mb-4 sm:mb-6">
                        Nomor tiket <strong>"{{ request('ticket') }}"</strong> tidak cocok dengan data pengaduan manapun. Mohon periksa kembali nomor tiket Anda.
                    </p>
                    <a href="{{ route('complaints.create') }}" class="inline-block bg-[#ff0000] text-white font-bold px-5 py-2.5 rounded-xl text-xs hover:bg-[#d90000] transition">
                        Buat Pengaduan Baru
                    </a>
                </div>
            @endif
        @endif

    </main>

    <!-- Footer Simple -->
    <footer class="bg-[#0b0146] text-slate-400 py-6 border-t-2 border-[#ff0000] text-xs text-center pb-20 md:pb-6">
        <p>&copy; {{ date('Y') }} KAMJA Portal • Layanan Pengaduan Masyarakat</p>
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

            <a href="{{ route('complaints.track') }}" class="flex flex-col items-center justify-center py-1 text-[#ff0000]">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-[10px] font-semibold">Lacak</span>
            </a>

            <a href="{{ route('home') }}#berita-section" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="text-[10px] font-semibold">Berita</span>
            </a>

        </div>
    </nav>

</body>

</html>
