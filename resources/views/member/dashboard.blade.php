<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Dashboard Penulis') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola karya tulis Anda, pantau status tinjauan admin, dan publikasikan berita.</p>
            </div>
            <a href="{{ route('posts.create') }}" 
               class="bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-red-600/30 flex items-center gap-2 self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tulis Berita Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-xs sm:text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Banner Sambutan Penulis (Navy #0b0146 & Red #ff0000 Accent) -->
        <div class="bg-gradient-to-r from-[#0b0146] via-[#12036e] to-[#0b0146] rounded-3xl shadow-xl p-8 text-white flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-[#ff0000]/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-slate-200 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Akun Kontributor Aktif
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-2 text-white">Halo, {{ Auth::user()->name }}! ✍️</h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                    Setiap tulisan berita yang Anda buat akan ditinjau oleh tim redaksi kami sebelum diterbitkan secara resmi ke halaman portal publik.
                </p>
            </div>
            
            <div class="flex items-center gap-3 shrink-0 relative z-10 w-full sm:w-auto">
                <a href="{{ route('home') }}" target="_blank"
                    class="w-full sm:w-auto text-center bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-5 py-3 rounded-xl transition text-xs sm:text-sm">
                    Lihat Berita Terbit
                </a>
                <a href="{{ route('posts.create') }}"
                    class="w-full sm:w-auto text-center bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-6 py-3 rounded-xl shadow-lg transition text-xs sm:text-sm">
                    + Buat Artikel
                </a>
            </div>
        </div>

        <!-- Ringkasan Statistik Penulis (3 Card Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Total Artikel -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Artikel Anda</span>
                    <span class="text-3xl font-extrabold text-[#0b0146]">{{ $myPosts->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-[#0b0146] flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>

            <!-- Menunggu Review -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-amber-600 uppercase tracking-wider block mb-1">Menunggu Review (Pending)</span>
                    <span class="text-3xl font-extrabold text-amber-600">{{ $myPosts->where('status', 'pending')->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Terbit -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider block mb-1">Sudah Terbit (Published)</span>
                    <span class="text-3xl font-extrabold text-emerald-600">{{ $myPosts->where('status', 'published')->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Tabel Artikel Buatan Member -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            
            <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="font-extrabold text-lg text-[#0b0146]">Daftar Artikel Saya</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau status publikasi dan perbarui isi artikel tulisan Anda.</p>
                </div>
                <a href="{{ route('posts.create') }}" class="bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-4 py-2 rounded-xl text-xs transition shadow-sm">
                    + Tulis Artikel
                </a>
            </div>

            @if($myPosts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Judul Artikel</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6">Tanggal Kirim</th>
                                <th class="py-4 px-6 text-center">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($myPosts as $post)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <!-- Judul -->
                                    <td class="py-4 px-6 font-bold text-slate-900 max-w-sm">
                                        @if($post->status === 'published')
                                            <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="hover:text-[#ff0000] transition line-clamp-1">
                                                {{ $post->title }}
                                            </a>
                                        @else
                                            <span class="line-clamp-1 text-slate-800">{{ $post->title }}</span>
                                        @endif
                                        <div class="text-[10px] text-slate-400 font-normal mt-0.5">
                                            {{ Str::limit(strip_tags($post->content), 60) }}
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="text-[#ff0000] font-bold text-[11px]">
                                            {{ $post->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    <!-- Tanggal -->
                                    <td class="py-4 px-6 text-slate-500 whitespace-nowrap text-[11px]">
                                        {{ $post->created_at->translatedFormat('d M Y, H:i') }}
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($post->status === 'published')
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-full border border-emerald-200">
                                                ● Terbit
                                            </span>
                                        @elseif($post->status === 'rejected')
                                            <span class="px-3 py-1 bg-rose-50 text-rose-700 text-[11px] font-bold rounded-full border border-rose-200">
                                                ● Ditolak
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[11px] font-bold rounded-full border border-amber-200">
                                                ● Menunggu Review
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Edit -->
                                            <a href="{{ route('posts.edit', $post->id) }}" 
                                               class="text-amber-700 hover:bg-amber-600 hover:text-white font-bold text-xs px-3 py-1.5 bg-amber-50 rounded-xl transition">
                                                Edit
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
                <div class="p-12 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-slate-700 text-base mb-1">Belum Ada Artikel</p>
                    <p class="text-xs text-slate-500 mb-4">Kamu belum menulis artikel berita apapun.</p>
                    <a href="{{ route('posts.create') }}" class="inline-block bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-6 py-2.5 rounded-xl text-xs transition shadow-sm">
                        Tulis Artikel Pertama Kamu &rarr;
                    </a>
                </div>
            @endif

        </div>

    </div>
</x-app-layout>
