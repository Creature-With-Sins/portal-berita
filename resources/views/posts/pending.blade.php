<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Antrean Moderasi Berita (Pending)') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Tinjau dan setujui artikel yang dikirimkan oleh penulis/kontributor.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition">
                &larr; Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-xs font-bold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-6 sm:p-8">
            @if($pendingPosts->isEmpty())
                <div class="py-12 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-slate-700 text-base mb-1">Semua Bersih!</p>
                    <p class="text-xs text-slate-400">Tidak ada berita yang sedang menunggu persetujuan saat ini.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="py-3.5 px-4">Sampul</th>
                                <th class="py-3.5 px-4">Judul Artikel</th>
                                <th class="py-3.5 px-4">Penulis</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4 text-center">Aksi Moderasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($pendingPosts as $post)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        @if($post->image || $post->image_url)
                                            <img src="{{ asset('storage/' . ($post->image ?? $post->image_url)) }}" class="w-20 h-14 object-cover rounded-xl border border-slate-200">
                                        @else
                                            <div class="w-20 h-14 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 text-[10px]">
                                                Tanpa Foto
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-slate-900 max-w-xs">
                                        <div class="line-clamp-2">{{ $post->title }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">{{ $post->created_at->translatedFormat('d M Y, H:i') }}</div>
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-700 whitespace-nowrap font-medium">
                                        {{ $post->author->name ?? 'Anonim' }}
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="bg-red-50 text-[#ff0000] text-[11px] font-bold px-2.5 py-1 rounded-lg border border-red-100">
                                            {{ $post->category->name ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.posts.review', $post->id) }}" class="bg-[#0b0146] hover:bg-[#14076e] text-white px-3 py-1.5 rounded-xl text-xs font-bold transition">
                                                Review
                                            </a>
                                            <!-- Approve -->
                                            <form action="{{ route('admin.posts.updateStatus', $post->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="published">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition">
                                                    Approve
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <form action="{{ route('admin.posts.updateStatus', $post->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 px-3 py-1.5 rounded-xl text-xs font-bold transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
