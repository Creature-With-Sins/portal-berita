<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Edit Artikel') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui rincian berita atau unggah thumbnail baru.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 sm:p-10 rounded-3xl border border-slate-200 shadow-sm">
            
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul Artikel -->
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Artikel <span class="text-[#ff0000]">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b0146]">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori <span class="text-[#ff0000]">*</span></label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b0146]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Gambar Utama -->
                <div>
                    <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Gambar Sampul (Thumbnail)</label>
                    @if($post->image || $post->image_url)
                        <div class="mb-3 w-48 h-32 bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                            <img src="{{ asset('storage/' . ($post->image ?? $post->image_url)) }}" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0b0146] file:text-white hover:file:bg-[#14076e] transition">
                </div>

                <!-- Isi Artikel -->
                <div>
                    <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Isi Artikel <span class="text-[#ff0000]">*</span></label>
                    <textarea name="content" id="editor" rows="8">{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 font-semibold rounded-xl text-xs hover:bg-slate-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-[#0b0146] hover:bg-[#14076e] text-white font-extrabold rounded-xl text-xs sm:text-sm transition shadow-md">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- Script CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => { console.error(error); });
    </script>
</x-app-layout>
