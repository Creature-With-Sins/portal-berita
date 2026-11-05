<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengaduan & Aspirasi Masyarakat - KAMJA Portal</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-[#ff0000] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar Sederhana & Elegan -->
    <header class="bg-[#0b0146] text-white shadow-lg border-b border-white/10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="p-1.5 bg-white rounded-xl shadow-md group-hover:scale-105 transition">
                    <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="h-9 w-auto" alt="Logo KAMJA">
                </div>
                <div>
                    <span class="font-extrabold text-xl text-white tracking-tight flex items-center gap-1">
                        KAMJA <span class="text-[#ff0000]">PORTAL</span>
                    </span>
                    <p class="text-[10px] text-slate-300 tracking-wider uppercase font-medium">Layanan Pengaduan Warga</p>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('complaints.track') }}" class="text-xs sm:text-sm font-semibold text-slate-200 hover:text-white px-3 py-2 rounded-xl hover:bg-white/10 transition">
                    Lacak Status Laporan
                </a>
                <a href="{{ route('home') }}" class="text-xs sm:text-sm font-bold bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl transition border border-white/15">
                    &larr; Beranda
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Form Area -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 flex-1 w-full">

        <!-- Banner Header Form -->
        <div class="bg-gradient-to-r from-[#0b0146] to-[#17047f] rounded-3xl p-6 sm:p-10 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-[#ff0000]/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="relative z-10 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#ff0000] text-white text-xs font-bold uppercase tracking-wider mb-3">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Bebas Akses • Tanpa Perlu Daftar / Login
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Formulir Pengaduan & Aspirasi Masyarakat</h1>
                <p class="text-slate-200 text-sm sm:text-base mt-2 leading-relaxed">
                    Sampaikan keluhan, aspirasi, atau pengajuan Anda kepada pihak terkait. Setiap pengaduan akan mendapatkan <strong class="text-white underline">Nomor Tiket Resmi</strong> yang dapat dipantau perkembangannya.
                </p>
            </div>
        </div>

        <!-- Card Form Input -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-10">
            
            <!-- Notifikasi Error Validasi -->
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-[#ff0000] rounded-r-2xl text-sm text-red-800">
                    <p class="font-bold flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-[#ff0000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Mohon periksa isian formulir:
                    </p>
                    <ul class="list-disc list-inside space-y-0.5 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Section 1: Data Identitas Pelapor -->
                <div>
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-[#0b0146] text-white flex items-center justify-center font-bold text-xs">1</span>
                        <h2 class="font-bold text-base text-[#0b0146]">Identitas Pelapor (Masyarakat)</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nama Lengkap <span class="text-[#ff0000]">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition">
                        </div>

                        <!-- No Telepon / WA -->
                        <div>
                            <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                No. WhatsApp / Telepon <span class="text-[#ff0000]">*</span>
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="Contoh: 081234567890"
                                   required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition">
                            <span class="text-[11px] text-slate-400 mt-1 block">Digunakan untuk informasi pembaruan status laporan Anda.</span>
                        </div>

                        <!-- Email (Opsional) -->
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Alamat Email <span class="text-slate-400 text-xs font-normal">(Opsional)</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   placeholder="Contoh: budi@gmail.com"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Rincian Pengaduan / Pengajuan -->
                <div class="pt-4">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-lg bg-[#ff0000] text-white flex items-center justify-center font-bold text-xs">2</span>
                        <h2 class="font-bold text-base text-[#0b0146]">Rincian Pengaduan / Usulan</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Kategori Pengaduan -->
                        <div>
                            <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Kategori Laporan <span class="text-[#ff0000]">*</span>
                            </label>
                            <select id="category" 
                                    name="category" 
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition font-medium">
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- Pilih Kategori Pengaduan --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Judul Pengaduan -->
                        <div>
                            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Judul / Pokok Pengaduan <span class="text-[#ff0000]">*</span>
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Lampu Penerangan Jalan Rusak di RT 03"
                                   required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition font-semibold">
                        </div>

                        <!-- Lokasi Terkait -->
                        <div>
                            <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Lokasi / Alamat Kejadian <span class="text-slate-400 text-xs font-normal">(Sangat dianjurkan)</span>
                            </label>
                            <input type="text" 
                                   id="location" 
                                   name="location" 
                                   value="{{ old('location') }}"
                                   placeholder="Contoh: Jl. Merdeka No. 12 dekat Kantor Pos"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition">
                        </div>

                        <!-- Isi Rincian Pengaduan -->
                        <div>
                            <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Isi & Rincian Pengaduan <span class="text-[#ff0000]">*</span>
                            </label>
                            <textarea id="content" 
                                      name="content" 
                                      rows="5" 
                                      placeholder="Jelaskan secara lengkap dan kronologis masalah yang ingin dilaporkan atau usulan yang ingin diajukan..."
                                      required
                                      class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition leading-relaxed">{{ old('content') }}</textarea>
                        </div>

                        <!-- Lampiran Bukti Foto / Dokumen -->
                        <div>
                            <label for="attachment" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Lampiran Foto / Bukti Dokumen <span class="text-slate-400 text-xs font-normal">(Opsional, maks 3MB)</span>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50 hover:bg-slate-100 transition">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-10 w-10 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="attachment" class="relative cursor-pointer bg-white rounded-lg px-2 py-1 font-semibold text-[#0b0146] hover:text-[#ff0000] focus-within:outline-none shadow-sm border border-slate-200">
                                            <span>Pilih Berkas Lampiran</span>
                                            <input id="attachment" name="attachment" type="file" accept="image/*,.pdf" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-slate-500">Mendukung format JPG, PNG, WEBP, atau PDF (Maksimal 3MB)</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Form & Tombol Submit -->
                <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Data laporan Anda tersimpan secara aman dan terenkripsi.
                    </p>

                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <a href="{{ route('home') }}" class="w-1/2 sm:w-auto text-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-100 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="w-1/2 sm:w-auto bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-8 py-3 rounded-xl shadow-lg shadow-red-600/30 transition-all duration-200 hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pengaduan
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </main>

    <!-- Footer Simple -->
    <footer class="bg-[#0b0146] text-slate-400 py-6 border-t-2 border-[#ff0000] text-xs text-center">
        <p>&copy; {{ date('Y') }} KAMJA Portal • Layanan Terbuka untuk Warga</p>
    </footer>

</body>

</html>
