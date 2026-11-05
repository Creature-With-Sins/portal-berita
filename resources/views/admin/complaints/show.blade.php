<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Detail & Respon Pengaduan') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Nomor Tiket: <span class="font-mono font-bold text-[#ff0000]">{{ $complaint->ticket_number }}</span></p>
            </div>
            <a href="{{ route('admin.complaints.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-4 py-2 rounded-xl text-xs sm:text-sm transition">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- SISI KIRI: Rincian Pengaduan (7 Kolom) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Card Konten Laporan -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-[#ff0000] uppercase tracking-wider block">
                                {{ $complaint->category }}
                            </span>
                            <h3 class="text-xl font-extrabold text-slate-900 mt-1">{{ $complaint->title }}</h3>
                        </div>
                        @php $meta = $complaint->status_meta; @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $meta['bg'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $meta['dot'] }}"></span>
                            {{ $meta['label'] }}
                        </span>
                    </div>

                    <!-- Profil Pelapor -->
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-2 text-xs">
                        <div class="font-bold text-slate-700 text-sm mb-2">Informasi Pelapor:</div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Nama Lengkap:</span>
                            <span class="font-bold text-slate-800">{{ $complaint->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Nomor WhatsApp:</span>
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-slate-800">{{ $complaint->phone }}</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $complaint->phone) }}?text={{ urlencode('Halo ' . $complaint->name . ', mengenai pengaduan Anda dengan nomor tiket ' . $complaint->ticket_number . ': ') }}" 
                                   target="_blank" 
                                   class="text-emerald-600 hover:text-emerald-700 font-bold underline inline-flex items-center gap-1">
                                    Hubungi WA &rarr;
                                </a>
                            </div>
                        </div>
                        @if($complaint->email)
                            <div class="flex justify-between">
                                <span class="text-slate-400">Email:</span>
                                <span class="text-slate-800">{{ $complaint->email }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-slate-400">Lokasi Terkait:</span>
                            <span class="font-medium text-slate-800">{{ $complaint->location ?? 'Tidak dicantumkan' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Waktu Masuk:</span>
                            <span class="text-slate-600">{{ $complaint->created_at->translatedFormat('l, d F Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <!-- Isi Lengkap Pengaduan -->
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Uraian / Isi Pengaduan:</h4>
                        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                            {{ $complaint->content }}
                        </div>
                    </div>

                    <!-- Lampiran Bukti -->
                    @if($complaint->attachment)
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Lampiran Bukti Pengaduan:</h4>
                            <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 p-2">
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="block group relative">
                                    <img src="{{ asset('storage/' . $complaint->attachment) }}" alt="Lampiran Bukti" class="w-full max-h-72 object-cover rounded-xl group-hover:opacity-90 transition">
                                    <div class="p-2 text-center text-xs font-bold text-[#0b0146] hover:underline">
                                        Klik untuk membuka gambar ukuran penuh &rarr;
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

            <!-- SISI KANAN: Form Respon & Tindak Lanjut Admin (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#ff0000]"></span>
                        <h3 class="font-extrabold text-lg text-[#0b0146]">Tanggapan & Status</h3>
                    </div>

                    <form action="{{ route('admin.complaints.updateStatus', $complaint->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <!-- Dropdown Status -->
                        <div>
                            <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Status Pengaduan:
                            </label>
                            <select id="status" 
                                    name="status" 
                                    required 
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold focus:bg-white focus:ring-2 focus:ring-[#0b0146] outline-none transition">
                                <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>
                                    🟡 Menunggu Review (Pending)
                                </option>
                                <option value="diproses" {{ $complaint->status === 'diproses' ? 'selected' : '' }}>
                                    🔵 Sedang Diproses (Tindak Lanjut Lapangan)
                                </option>
                                <option value="selesai" {{ $complaint->status === 'selesai' ? 'selected' : '' }}>
                                    🟢 Selesai / Laporan Dituntaskan
                                </option>
                                <option value="ditolak" {{ $complaint->status === 'ditolak' ? 'selected' : '' }}>
                                    🔴 Ditolak / Tidak Sesuai Ketentuan
                                </option>
                            </select>
                            <span class="text-[11px] text-slate-400 mt-1 block">
                                Status ini dapat dilihat secara publik oleh pelapor melalui fitur Lacak Pengaduan.
                            </span>
                        </div>

                        <!-- Isi Respon Admin -->
                        <div>
                            <label for="response" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Tanggapan / Jawaban Resmi Admin:
                            </label>
                            <textarea id="response" 
                                      name="response" 
                                      rows="6" 
                                      placeholder="Tuliskan jawaban tindak lanjut, penjelasan petugas, atau arahan penyelesaian untuk pelapor..."
                                      class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm leading-relaxed focus:bg-white focus:ring-2 focus:ring-[#0b0146] outline-none transition">{{ old('response', $complaint->response) }}</textarea>
                            @if($complaint->responded_at)
                                <span class="text-[10px] text-slate-400 mt-1 block">
                                    Terakhir dijawab pada: {{ $complaint->responded_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            @endif
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full bg-[#0b0146] hover:bg-[#14076e] text-white font-extrabold py-3.5 px-4 rounded-xl shadow-md transition text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Pembaruan & Kirim Respon
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>
