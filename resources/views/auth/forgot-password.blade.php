<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-[#ff0000] text-[11px] font-extrabold uppercase tracking-wider mb-2">
            Pemulihan Akun
        </div>
        <h1 class="text-2xl font-extrabold text-[#0b0146] tracking-tight">Lupa Kata Sandi?</h1>
        <p class="text-slate-500 text-xs mt-1 leading-relaxed">
            Masukkan alamat email Anda yang terdaftar, kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs font-semibold" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Alamat Email Terdaftar <span class="text-[#ff0000]">*</span>
            </label>
            <div class="relative">
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="nama@email.com"
                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-[#0b0146] focus:border-[#0b0146] outline-none transition font-medium">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="pt-3">
            <button type="submit" 
                    class="w-full bg-[#ff0000] hover:bg-[#d90000] text-white font-extrabold py-3.5 px-4 rounded-xl shadow-lg shadow-red-600/30 transition-all duration-200 hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                <span>Kirim Tautan Reset Sandi</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>

        <div class="text-center pt-4 border-t border-slate-100">
            <a href="{{ route('login') }}" class="text-xs font-bold text-[#0b0146] hover:text-[#ff0000] transition">
                &larr; Kembali ke Halaman Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
