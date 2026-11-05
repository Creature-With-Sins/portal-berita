<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-[#0b0146] leading-tight">
                    {{ __('Tulis Berita Baru') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Tulis artikel berita informatif untuk pembaca portal.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-[#ff0000] text-red-800 rounded-r-2xl text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Judul Berita <span class="text-[#ff0000]">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="Masukkan judul berita yang menarik..." 
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-[#0b0146] outline-none transition" 
                       required>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Kategori <span class="text-[#ff0000]">*</span>
                </label>
                <select name="category_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-2 focus:ring-[#0b0146] outline-none transition" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Thumbnail -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Gambar Utama (Thumbnail)
                </label>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#0b0146] file:text-white hover:file:bg-[#14076e] transition">
                <span class="text-[11px] text-slate-400 mt-1 block">Format: JPG, PNG, WEBP (Maksimal 2MB)</span>
            </div>

            <!-- Isi Berita -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Isi Berita <span class="text-[#ff0000]">*</span>
                </label>
                <textarea id="editor" name="content">{{ old('content') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold px-6 py-3 rounded-xl shadow-md transition text-xs sm:text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Terbitkan Berita
                </button>
            </div>
        </form>
    </div>

    <!-- Script CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => { console.error(error); });
    </script>
</x-app-layout>
