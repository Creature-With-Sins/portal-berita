<!-- MOBILE BOTTOM APP BAR (Fixed di HP ala Mobile App) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0b0146]/95 backdrop-blur-md border-t border-white/10 px-2 py-1.5 shadow-2xl">
    <div class="grid grid-cols-5 items-center justify-around text-center">
        
        <!-- 1. Beranda -->
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1 {{ request()->routeIs('home') && !request('category') ? 'text-[#ff0000]' : 'text-slate-300 hover:text-white' }} transition">
            <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-[10px] font-semibold">Beranda</span>
        </a>

        <!-- 2. Berita -->
        <a href="{{ route('home') }}#berita-section" class="flex flex-col items-center justify-center py-1 {{ request()->routeIs('posts.show') ? 'text-[#ff0000]' : 'text-slate-300 hover:text-white' }} transition">
            <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <span class="text-[10px] font-semibold">Berita</span>
        </a>

        <!-- 3. Center Floating Action Button: Lapor -->
        <a href="{{ route('complaints.create') }}" class="flex flex-col items-center justify-center -mt-5 group">
            <div class="w-12 h-12 rounded-full {{ request()->routeIs('complaints.create') ? 'bg-[#ff0000] ring-4 ring-[#ff0000]/40' : 'bg-[#ff0000]' }} text-white flex items-center justify-center shadow-lg shadow-red-600/50 border-4 border-[#0b0146] group-active:scale-95 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <span class="text-[10px] font-bold text-white mt-0.5">Lapor</span>
        </a>

        <!-- 4. Lacak Pengaduan -->
        <a href="{{ route('complaints.track') }}" class="flex flex-col items-center justify-center py-1 {{ request()->routeIs('complaints.track') ? 'text-[#ff0000]' : 'text-slate-300 hover:text-white' }} transition">
            <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            <span class="text-[10px] font-semibold">Lacak</span>
        </a>

        <!-- 5. Akun / Cari -->
        @auth
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center py-1 {{ request()->routeIs('dashboard*') ? 'text-[#ff0000]' : 'text-slate-300 hover:text-white' }} transition">
                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-[10px] font-semibold">Akun</span>
            </a>
        @else
            @if(request()->routeIs('home'))
                <button @click="searchOpen = true" type="button" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white transition">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="text-[10px] font-semibold">Cari</span>
                </button>
            @else
                <a href="{{ route('home') }}#berita-section" class="flex flex-col items-center justify-center py-1 text-slate-300 hover:text-white transition">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="text-[10px] font-semibold">Cari</span>
                </a>
            @endif
        @endauth
        
    </div>
</nav>
