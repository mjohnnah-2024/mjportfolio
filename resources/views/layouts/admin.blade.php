<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ ($title ?? 'Admin') }} — MJ Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>
<body class="h-full bg-gray-100 dark:bg-zinc-950 antialiased" x-data="{ sidebarOpen: false }">

<div class="flex h-full">
    {{-- Sidebar --}}
    <aside
        class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 bg-white dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800"
        aria-label="Admin navigation"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-200 dark:border-zinc-800">
            <div class="w-9 h-9 rounded-xl bg-purple-700 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="text-white font-bold text-sm">MJ</span>
            </div>
            <div>
                <p class="font-semibold text-gray-900 dark:text-white text-sm">Portfolio Admin</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Mark Johnnah</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto" aria-label="Sidebar navigation">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'icon' => 'squares-2x2', 'label' => 'Dashboard'],
                    ['route' => 'admin.projects.index', 'icon' => 'folder', 'label' => 'Projects'],
                    ['route' => 'admin.skills.index', 'icon' => 'sparkles', 'label' => 'Skills'],
                    ['route' => 'admin.experience.index', 'icon' => 'briefcase', 'label' => 'Experience'],
                    ['route' => 'admin.messages.index', 'icon' => 'envelope', 'label' => 'Messages'],
                    ['route' => 'admin.settings.general', 'icon' => 'cog-6-tooth', 'label' => 'Settings'],
                    ['route' => 'admin.profile', 'icon' => 'user', 'label' => 'My Profile'],
                ];
            @endphp
            @foreach($navItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-colors
                        {{ request()->routeIs($item['route'] . '*')
                            ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400'
                            : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-800' }}"
                    aria-current="{{ request()->routeIs($item['route'] . '*') ? 'page' : 'false' }}"
                >
                    <flux:icon name="{{ $item['icon'] }}" class="w-4 h-4 flex-shrink-0" aria-hidden="true" />
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Bottom --}}
        <div class="px-4 py-4 border-t border-gray-200 dark:border-zinc-800 space-y-1">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">
                <flux:icon name="arrow-top-right-on-square" class="w-4 h-4" aria-hidden="true" />
                View Site
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded-xl hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">
                    <flux:icon name="arrow-left-start-on-rectangle" class="w-4 h-4" aria-hidden="true" />
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 lg:pl-64 flex flex-col min-h-full">
        {{-- Top bar --}}
        <header class="sticky top-0 z-40 bg-white dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button
                    @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden text-gray-500 hover:text-gray-900 dark:hover:text-white"
                    aria-label="Toggle navigation"
                >
                    <flux:icon name="bars-3" class="w-5 h-5" aria-hidden="true" />
                </button>
                <h1 class="text-base font-semibold text-gray-900 dark:text-white">{{ $title ?? 'Admin' }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600 dark:text-gray-400 hidden sm:inline">{{ auth()->user()?->name }}</span>
                <div class="w-8 h-8 rounded-full bg-purple-700 flex items-center justify-center text-white text-xs font-bold" aria-hidden="true">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'M', 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 px-6 py-8" id="main-content">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
@fluxScripts
</body>
</html>
