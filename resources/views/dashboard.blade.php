<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Panel Kontrol Admin') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola publikasi berita, moderasi kontributor, dan tanggapi pengaduan masyarakat.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.complaints.index') }}" 
                   class="bg-white border border-slate-200 hover:border-[#0b0146] text-[#0b0146] font-bold px-4 py-2 rounded-xl text-xs sm:text-sm transition shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#ff0000]"></span>
                    Pengaduan Warga
                </a>
                <a href="{{ route('posts.create') }}" 
                   class="bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-4 py-2 rounded-xl text-xs sm:text-sm transition shadow-md flex items-center gap-1.5">
                    + Tulis Berita
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Banner Selamat Datang (Navy #0b0146 & Red #ff0000 CTA) -->
        <div class="bg-gradient-to-r from-[#0b0146] via-[#12036e] to-[#0b0146] rounded-3xl shadow-xl p-8 text-white flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-[#ff0000]/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-slate-200 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Admin Panel Aktif
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                    Kelola artikel portal berita, setujui draf kiriman kontributor, serta pantau dan tindak lanjuti laporan dari masyarakat secara cepat dan terpadu.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0 relative z-10 w-full sm:w-auto">
                <a href="{{ route('admin.complaints.index') }}"
                    class="w-full sm:w-auto text-center bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition text-xs sm:text-sm">
                    Tinjau Pengaduan
                </a>
                <a href="{{ route('posts.create') }}"
                    class="w-full sm:w-auto text-center bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-6 py-3 rounded-xl shadow-lg transition text-xs sm:text-sm">
                    + Buat Berita Baru
                </a>
            </div>
        </div>

        <!-- Menu Akses Cepat (4 Card Grid) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Pengaduan Warga (Fitur Baru) -->
            @php
                $pendingComplaintsCount = \App\Models\Complaint::where('status', 'pending')->count();
            @endphp
            <a href="{{ route('admin.complaints.index') }}" class="bg-white p-5 rounded-3xl shadow-sm border border-slate-200 hover:border-[#ff0000] hover:shadow-md transition block group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-red-50 text-[#ff0000] rounded-2xl flex items-center justify-center font-bold group-hover:bg-[#ff0000] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    @if($pendingComplaintsCount > 0)
                        <span class="bg-[#ff0000] text-white text-xs font-extrabold px-2.5 py-1 rounded-full animate-pulse">
                            {{ $pendingComplaintsCount }} Baru
                        </span>
                    @endif
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1 group-hover:text-[#ff0000]">Pengaduan Warga</h3>
                <p class="text-slate-500 text-xs">Aspirasi & keluhan masyarakat tanpa akun untuk ditinjau.</p>
            </a>

            <!-- Card 2: Moderasi Berita Pending -->
            @php
                $pendingPostsCount = \App\Models\Post::where('status', 'pending')->count();
            @endphp
            <a href="{{ route('admin.posts.pending') }}" class="bg-white p-5 rounded-3xl shadow-sm border border-slate-200 hover:border-[#0b0146] hover:shadow-md transition block group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-blue-50 text-[#0b0146] rounded-2xl flex items-center justify-center font-bold group-hover:bg-[#0b0146] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    @if($pendingPostsCount > 0)
                        <span class="bg-amber-400 text-slate-900 text-xs font-extrabold px-2.5 py-1 rounded-full">
                            {{ $pendingPostsCount }} Antrean
                        </span>
                    @endif
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1 group-hover:text-[#0b0146]">Moderasi Berita</h3>
                <p class="text-slate-500 text-xs">Persetujuan artikel yang dikirim oleh member/penulis.</p>
            </a>

            <!-- Card 3: Buat Berita Baru -->
            <a href="{{ route('posts.create') }}" class="bg-white p-5 rounded-3xl shadow-sm border border-slate-200 hover:border-[#0b0146] hover:shadow-md transition block group">
                <div class="w-12 h-12 bg-slate-100 text-[#0b0146] rounded-2xl flex items-center justify-center mb-3 font-bold group-hover:bg-[#0b0146] group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1 group-hover:text-[#0b0146]">Tulis Berita Baru</h3>
                <p class="text-slate-500 text-xs">Terbitkan artikel resmi langsung atas nama Admin.</p>
            </a>

            <!-- Card 4: Lihat Portal Publik -->
            <a href="{{ route('home') }}" target="_blank" class="bg-white p-5 rounded-3xl shadow-sm border border-slate-200 hover:border-emerald-600 hover:shadow-md transition block group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-3 font-bold group-hover:bg-emerald-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1 group-hover:text-emerald-600">Lihat Halaman Publik</h3>
                <p class="text-slate-500 text-xs">Kunjungi beranda portal berita & form pengaduan umum.</p>
            </a>

        </div>

        <!-- Tabel Kelola Semua Artikel -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="font-extrabold text-[#0b0146] text-lg">Semua Artikel Portal Berita</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola, tinjau, edit, atau hapus seluruh artikel di database.</p>
                </div>
                <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                    Total: {{ $posts->count() }} Berita
                </span>
            </div>

            @if(isset($posts) && $posts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase tracking-wider font-bold">
                                <th class="py-4 px-6">Judul Artikel</th>
                                <th class="py-4 px-6">Penulis</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6 text-center">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($posts as $post)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <!-- Judul Artikel -->
                                    <td class="py-4 px-6 font-bold text-slate-900 max-w-sm">
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="hover:text-[#ff0000] transition line-clamp-1">
                                            {{ $post->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-400 font-normal mt-0.5">
                                            {{ $post->created_at->translatedFormat('d M Y, H:i') }}
                                        </div>
                                    </td>
                                    <!-- Penulis -->
                                    <td class="py-4 px-6 text-slate-700 whitespace-nowrap">
                                        <span class="font-semibold">{{ $post->author->name ?? 'Anonim' }}</span>
                                    </td>
                                    <!-- Kategori -->
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="text-[#ff0000] font-bold text-[11px]">
                                            {{ $post->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <!-- Status Badge -->
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($post->status === 'published')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-full border border-emerald-200">
                                                ● Published
                                            </span>
                                        @elseif($post->status === 'rejected')
                                            <span class="px-3 py-1 bg-rose-50 text-rose-700 text-[11px] font-bold rounded-full border border-rose-200">
                                                ● Rejected
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[11px] font-bold rounded-full border border-amber-200">
                                                ● Pending
                                            </span>
                                        @endif
                                    </td>
                                    <!-- Tombol Aksi Admin -->
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Review -->
                                            <a href="{{ route('admin.posts.review', $post->id) }}" class="text-[#0b0146] hover:bg-[#0b0146] hover:text-white font-bold text-xs px-3 py-1.5 bg-slate-100 rounded-xl transition">
                                                Review
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('posts.edit', $post->id) }}" class="text-amber-700 hover:bg-amber-600 hover:text-white font-bold text-xs px-3 py-1.5 bg-amber-50 rounded-xl transition">
                                                Edit
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:bg-rose-600 hover:text-white font-bold text-xs px-3 py-1.5 bg-rose-50 rounded-xl transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center text-slate-400 text-sm">
                    Belum ada artikel yang dibuat di dalam database.
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
