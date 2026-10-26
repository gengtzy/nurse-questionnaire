<nav x-data="{ open: false }" class="bg-white border-b border-[#d2dedc] sticky top-0 z-30">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-4">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo_welas_asih.png') }}" alt="Logo RSUD Welas Asih" class="w-10 h-10 object-contain shrink-0">
                        <div>
                            <span class="font-display font-bold text-base text-[#132628] leading-tight block">Nurse Recharge</span>
                            <span class="text-[11px] text-[#0b6b63] font-medium tracking-wide block uppercase font-mono">UBK 2 · RSUD Welas Asih</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-6 sm:flex">
                    @auth
                        @if (Auth::user()->role === 'Kepala Ruangan')
                            <x-nav-link :href="route('admin.rekap')" :active="request()->routeIs('admin.rekap*')" class="text-sm font-semibold text-[#132628]">
                                📊 {{ __('Monitoring Ruangan') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-semibold text-[#132628]">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-[#d2dedc] rounded-xl text-sm font-medium text-[#132628] bg-[#f9fbfa] hover:bg-[#f1f5f4] focus:outline-none transition">
                                <div class="w-7 h-7 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left">
                                    <div class="text-xs font-semibold text-[#132628] leading-none">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] text-[#0b6b63] font-mono leading-tight">{{ Auth::user()->role }}</div>
                                </div>

                                <div class="ms-1 text-[#4a6366]">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-[#0b6b63] hover:underline">
                        Masuk &rarr;
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->role === 'Kepala Ruangan')
                    <x-responsive-nav-link :href="route('admin.rekap')" :active="request()->routeIs('admin.rekap*')">
                        📊 {{ __('Monitoring Ruangan') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-[#0b6b63] font-mono">{{ Auth::user()->role }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-2">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-[#0b6b63]">Masuk Perawat &rarr;</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
