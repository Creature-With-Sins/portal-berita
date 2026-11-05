<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Review Kelayakan Berita') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Tinjau seluruh isi konten sebelum memutuskan diterbitkan ke publik.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition">
                &larr; Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Card Preview Berita -->
        <div class="bg-white p-6 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            
            <!-- Meta Bar -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <span class="text-xs font-extrabold text-[#ff0000] uppercase tracking-wider block mb-1">
                        {{ $post->category->name ?? 'Umum' }}
                    </span>
                    <p class="text-xs text-slate-400">
                        Penulis: <strong class="text-slate-700 font-semibold">{{ $post->author->name ?? 'Anonim' }}</strong> • {{ $post->created_at->translatedFormat('d F Y, H:i') }} WIB
                    </p>
                </div>
                <div>
                    @if($post->status === 'published')
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">Published</span>
                    @elseif($post->status === 'rejected')
                        <span class="px-3 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-200">Ditolak</span>
                    @else
                        <span class="px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-200">Pending Review</span>
                    @endif
                </div>
            </div>

            <!-- Judul -->
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0b0146] leading-snug">{{ $post->title }}</h1>

            <!-- Gambar Utama -->
            @if($post->image || $post->image_url)
                <div class="w-full max-h-96 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 shadow-sm">
                    <img src="{{ asset('storage/' . ($post->image ?? $post->image_url)) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Isi Konten Artikel -->
            <div class="prose max-w-none text-slate-800 leading-relaxed text-base pt-2">
                {!! $post->content !!}
            </div>

            <!-- Action Bar Approval (ACC / Tolak) -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <!-- Form Reject -->
                <form action="{{ route('admin.posts.updateStatus', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak berita ini?')">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="px-5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-xl text-xs sm:text-sm transition">
                        Tolak Artikel
                    </button>
                </form>

                <!-- Form Approve -->
                <form action="{{ route('admin.posts.updateStatus', $post->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="published">
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-xl text-xs sm:text-sm transition shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        ACC & Terbitkan Sekarang
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
