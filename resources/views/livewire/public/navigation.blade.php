<nav class="sticky top-0 z-50 bg-white/95 dark:bg-zinc-950/95 backdrop-blur-sm border-b border-gray-200 dark:border-zinc-800" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Mark Johnnah — Home">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-purple-700 group-hover:bg-purple-800 text-white font-bold text-base tracking-tight transition-colors select-none" aria-hidden="true">MJ</span>
                <span class="font-semibold text-gray-900 dark:text-white text-sm hidden sm:block">Mark Johnnah</span>
            </a>

            {{-- Desktop nav links --}}
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'About', 'route' => 'about'],
                        ['label' => 'Projects', 'route' => 'projects.index'],
                        ['label' => 'AI Help', 'route' => 'ai-help'],
                        ['label' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp
                @foreach($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors
                            {{ request()->routeIs($link['route'])
                                ? 'text-purple-700 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20'
                                : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-zinc-800' }}"
                        @if(request()->routeIs($link['route'])) aria-current="page" @endif
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop right actions --}}
            <div class="hidden md:flex items-center gap-3">
                <button
                    x-data
                    x-on:click="
                        const isDark = document.documentElement.classList.toggle('dark');
                        localStorage.setItem('darkMode', isDark);
                    "
                    class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors"
                    aria-label="Toggle dark mode"
                >
                    <svg class="w-4 h-4 dark:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>
                    <svg class="w-4 h-4 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /></svg>
                </button>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2">
                    Hire Me
                </a>
            </div>

            {{-- Mobile menu button --}}
            <button
                wire:click="toggleMobileMenu"
                class="md:hidden p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors"
                aria-expanded="{{ $mobileMenuOpen ? 'true' : 'false' }}"
                aria-controls="mobile-menu"
                aria-label="{{ $mobileMenuOpen ? 'Close menu' : 'Open menu' }}"
            >
                @if($mobileMenuOpen)
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                @else
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                @endif
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    @if($mobileMenuOpen)
        <div id="mobile-menu" class="md:hidden border-t border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 px-4 pb-4 pt-2">
            <nav class="flex flex-col gap-1" aria-label="Mobile navigation">
                @php
                    $navLinks = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'About', 'route' => 'about'],
                        ['label' => 'Projects', 'route' => 'projects.index'],
                        ['label' => 'AI Help', 'route' => 'ai-help'],
                        ['label' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp
                @foreach($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        wire:click="closeMobileMenu"
                        class="px-4 py-3 rounded-md text-sm font-medium transition-colors
                            {{ request()->routeIs($link['route'])
                                ? 'text-purple-700 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20'
                                : 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-zinc-800' }}"
                        @if(request()->routeIs($link['route'])) aria-current="page" @endif
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <div class="border-t border-gray-200 dark:border-zinc-800 mt-2 pt-2">
                    <a href="{{ route('contact') }}" class="block px-4 py-3 text-center bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-lg transition-colors">
                        Hire Me
                    </a>
                </div>
            </nav>
        </div>
    @endif
</nav>
