<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ filled($title ?? null) ? $title . ' — Mark Johnnah' : 'Mark Johnnah — Full-Stack Laravel Developer & Software Architect' }}</title>
    <meta name="description" content="{{ $description ?? 'Mark Johnnah is a senior full-stack Laravel developer, software architect and AI-assisted development engineer based in Papua New Guinea.' }}" />

    {{-- Open Graph --}}
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ filled($title ?? null) ? $title . ' — Mark Johnnah' : 'Mark Johnnah — Full-Stack Laravel Developer & Software Architect' }}" />
    <meta property="og:description" content="{{ $description ?? 'Mark Johnnah is a senior full-stack Laravel developer, software architect and AI-assisted development engineer.' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Mark Johnnah" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ filled($title ?? null) ? $title . ' — Mark Johnnah' : 'Mark Johnnah' }}" />
    <meta name="twitter:description" content="{{ $description ?? 'Senior full-stack Laravel developer, software architect and AI-assisted development engineer.' }}" />

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Structured Data --}}
    @stack('schema')

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-zinc-950 text-gray-900 dark:text-gray-100 min-h-screen antialiased">
    {{-- Skip to content --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-brand-800 text-white px-4 py-2 rounded z-50">
        Skip to main content
    </a>

    {{-- Navigation --}}
    <livewire:public.navigation />

    {{-- Main content --}}
    <main id="main-content" tabindex="-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('partials.public-footer')

    @livewireScripts
    @fluxScripts
    @stack('scripts')
</body>
</html>
