<nav x-data="{ open: false }" class="bg-[#0b0146] text-white border-b border-white/10 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="p-1 bg-white rounded-lg">
                            <img src="{{ asset('images/Logo KAMJA_Mark Kamja Main.png') }}" class="block h-8 w-auto" alt="Logo" />
                        </div>
                        <span class="font-extrabold text-white text-lg tracking-tight hidden sm:inline">
                            KAMJA <span class="text-[#ff0000]">PORTAL</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-[#ff0000] text-white font-extrabold' : 'border-transparent text-slate-300 hover:text-white' }} text-sm font-semibold transition">
                        Dashboard
                    </a>

                    @if(Auth::user()->role === 'admin')
                        <!-- Menu Admin: Pengaduan Masyarakat -->
                        <a href="{{ route('admin.complaints.index') }}" class="inline-flex items-center gap-1.5 px-1 pt-1 border-b-2 {{ request()->routeIs('admin.complaints.*') ? 'border-[#ff0000] text-white font-extrabold' : 'border-transparent text-slate-300 hover:text-white' }} text-sm font-semibold transition">
                            <span>Pengaduan Warga</span>
                            @php
                                $pendingComplaintsCount = \App\Models\Complaint::where('status', 'pending')->count();
                            @endphp
                            @if($pendingComplaintsCount > 0)
                                <span class="bg-[#ff0000] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                    {{ $pendingComplaintsCount }}
                                </span>
                            @endif
                        </a>

                        <!-- Menu Admin: Berita Pending -->
                        <a href="{{ route('admin.posts.pending') }}" class="inline-flex items-center gap-1.5 px-1 pt-1 border-b-2 {{ request()->routeIs('admin.posts.pending') ? 'border-[#ff0000] text-white font-extrabold' : 'border-transparent text-slate-300 hover:text-white' }} text-sm font-semibold transition">
                            <span>Moderasi Berita</span>
                            @php
                                $pendingPostsCount = \App\Models\Post::where('status', 'pending')->count();
                            @endphp
                            @if($pendingPostsCount > 0)
                                <span class="bg-amber-400 text-slate-900 text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                    {{ $pendingPostsCount }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1 px-1 pt-1 border-b-2 border-transparent text-slate-300 hover:text-white text-sm font-semibold transition">
                        <span>Lihat Portal Publik</span>
                        <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-white/20 text-xs leading-4 font-bold rounded-xl text-white bg-white/10 hover:bg-white/20 focus:outline-none transition shadow-sm">
                            <span class="w-2 h-2 rounded-full {{ Auth::user()->role === 'admin' ? 'bg-[#ff0000]' : 'bg-emerald-400' }}"></span>
                            <div>{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</div>

                            <svg class="fill-current h-4 w-4 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile & Akun') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-rose-600 font-bold">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#07002e] border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')" class="text-white">
                    {{ __('Pengaduan Warga') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.posts.pending')" :active="request()->routeIs('admin.posts.pending')" class="text-white">
                    {{ __('Moderasi Berita') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('home')" target="_blank" class="text-slate-300">
                {{ __('Lihat Portal Berita') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-2 border-t border-white/10 px-4">
            <div class="font-bold text-sm text-white">{{ Auth::user()->name }}</div>
            <div class="text-xs text-slate-400">{{ Auth::user()->email }} ({{ ucfirst(Auth::user()->role) }})</div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-slate-200">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-[#ff0000] font-bold">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
