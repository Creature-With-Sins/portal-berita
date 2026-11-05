<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Kelola Pengaduan Masyarakat') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Daftar aspirasi, laporan, dan permohonan yang diajukan oleh masyarakat umum.</p>
            </div>
            <a href="{{ route('complaints.create') }}" target="_blank" class="bg-[#ff0000] hover:bg-[#d90000] text-white font-bold px-4 py-2 rounded-xl text-xs sm:text-sm transition shadow-sm flex items-center gap-1.5 self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                Buka Form Publik
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Statistik Pengaduan -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <!-- Total -->
            <a href="{{ route('admin.complaints.index') }}" 
               class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-[#0b0146] transition {{ !request('status') || request('status') === 'all' ? 'ring-2 ring-[#0b0146]' : '' }}">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Laporan</span>
                <span class="text-2xl font-extrabold text-[#0b0146]">{{ $stats['total'] }}</span>
            </a>

            <!-- Pending -->
            <a href="{{ route('admin.complaints.index', ['status' => 'pending']) }}" 
               class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-amber-400 transition {{ request('status') === 'pending' ? 'ring-2 ring-amber-400' : '' }}">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider block mb-1">Perlu Review</span>
                <span class="text-2xl font-extrabold text-amber-600">{{ $stats['pending'] }}</span>
            </a>

            <!-- Diproses -->
            <a href="{{ route('admin.complaints.index', ['status' => 'diproses']) }}" 
               class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-500 transition {{ request('status') === 'diproses' ? 'ring-2 ring-blue-500' : '' }}">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider block mb-1">Diproses</span>
                <span class="text-2xl font-extrabold text-blue-600">{{ $stats['diproses'] }}</span>
            </a>

            <!-- Selesai -->
            <a href="{{ route('admin.complaints.index', ['status' => 'selesai']) }}" 
               class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition {{ request('status') === 'selesai' ? 'ring-2 ring-emerald-500' : '' }}">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider block mb-1">Selesai</span>
                <span class="text-2xl font-extrabold text-emerald-600">{{ $stats['selesai'] }}</span>
            </a>

            <!-- Ditolak -->
            <a href="{{ route('admin.complaints.index', ['status' => 'ditolak']) }}" 
               class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-rose-500 transition {{ request('status') === 'ditolak' ? 'ring-2 ring-rose-500' : '' }}">
                <span class="text-xs font-bold text-rose-600 uppercase tracking-wider block mb-1">Ditolak</span>
                <span class="text-2xl font-extrabold text-rose-600">{{ $stats['ditolak'] }}</span>
            </a>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm">
            <form action="{{ route('admin.complaints.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center justify-between">
                
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-1 focus:ring-[#0b0146] outline-none">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <!-- Kategori Filter -->
                    <select name="category" onchange="this.form.submit()" class="text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-1 focus:ring-[#0b0146] outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Input -->
                <div class="w-full md:w-80 relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari no tiket, nama, judul, no HP..." 
                           class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-1 focus:ring-[#0b0146] outline-none">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

            </form>
        </div>

        <!-- Tabel Daftar Pengaduan -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase tracking-wider font-bold">
                            <th class="py-4 px-6">Tiket & Tanggal</th>
                            <th class="py-4 px-6">Pelapor & Kontak</th>
                            <th class="py-4 px-6">Kategori & Pokok Masalah</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($complaints as $item)
                            @php $meta = $item->status_meta; @endphp
                            <tr class="hover:bg-slate-50/70 transition">
                                <!-- Tiket & Tanggal -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-mono font-bold text-[#0b0146] text-sm">{{ $item->ticket_number }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</div>
                                </td>

                                <!-- Pelapor & Kontak -->
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-800 text-sm">{{ $item->name }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1 font-mono">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1-.4-1.1-.6-2.3-.6-3.5 0-.6-.4-1-1-1H4c-.6 0-1 .4-1 1 0 9.4 7.6 17 17 17 .6 0 1-.4 1-1v-3.5c0-.6-.4-1-1-1zM19 12h2a9 9 0 0 0-9-9v2a7 7 0 0 1 7 7z"/>
                                        </svg>
                                        {{ $item->phone }}
                                    </div>
                                    @if($item->location)
                                        <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-xs">📍 {{ $item->location }}</div>
                                    @endif
                                </td>

                                <!-- Kategori & Judul -->
                                <td class="py-4 px-6 max-w-md">
                                    <span class="inline-block text-[10px] font-bold text-[#ff0000] uppercase tracking-wider mb-1">
                                        {{ $item->category }}
                                    </span>
                                    <div class="font-bold text-slate-900 text-sm line-clamp-1">
                                        {{ $item->title }}
                                    </div>
                                    <div class="text-slate-500 text-xs line-clamp-1 mt-0.5">
                                        {{ Str::limit($item->content, 80) }}
                                    </div>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold border {{ $meta['bg'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $meta['dot'] }}"></span>
                                        {{ $meta['label'] }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.complaints.show', $item->id) }}" 
                                           class="bg-[#0b0146] hover:bg-[#14076e] text-white font-bold px-3 py-1.5 rounded-xl transition text-xs shadow-sm">
                                            Tinjau & Respon
                                        </a>

                                        <form action="{{ route('admin.complaints.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengaduan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus Pengaduan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400 text-sm">
                                    Tidak ada data pengaduan yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($complaints->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                    {{ $complaints->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
