<div>
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-24 lg:py-36">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(128,0,128,0.15),transparent_70%)] pointer-events-none" aria-hidden="true"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-700 text-white font-bold text-2xl tracking-tight mb-8 select-none shadow-lg shadow-purple-900/30" aria-hidden="true">MJ</div>
                <h1 class="text-4xl sm:text-5xl lg:text-5xl font-bold tracking-tight leading-tight mb-6">
                    Building Secure, Scalable and<br class="hidden sm:block">
                    <span class="text-purple-400">AI-Assisted</span> Web Applications
                </h1>
                <p class="text-lg lg:text-xl text-gray-300 leading-relaxed mb-10 max-w-2xl">
                    I am a full-stack Laravel developer, software architect and DevOps professional with more than 15 years of experience across web applications, infrastructure and hosting platforms. I currently focus on controlled agentic software development using Laravel AI SDK, Claude Code, GPT, Gemini and open-source LLMs.
                </p>
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-700 hover:bg-purple-600 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-purple-900/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-400 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-950">
                        View My Projects
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-purple-500/50 hover:border-purple-400 text-white font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-400 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-950">
                        Contact Me
                    </a>
                </div>
                <div class="flex items-center gap-5">
                    <a href="{{ config('portfolio.github') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-gray-400 hover:text-purple-400 transition-colors" aria-label="GitHub profile">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                        GitHub
                    </a>
                    <a href="{{ config('portfolio.linkedin') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-gray-400 hover:text-purple-400 transition-colors" aria-label="LinkedIn profile">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Experience Stats --}}
    <section class="bg-white dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-800" aria-label="Experience highlights">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <dl class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['value' => '15+', 'label' => 'Years Experience'],
                    ['value' => '3', 'label' => 'Tech Stacks'],
                    ['value' => '7', 'label' => 'Skill Categories'],
                    ['value' => 'PNG', 'label' => 'Based In'],
                ] as $stat)
                    <div class="text-center">
                        <dt class="text-3xl font-bold text-purple-700 dark:text-purple-400">{{ $stat['value'] }}</dt>
                        <dd class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $stat['label'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- Expertise Cards --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20" aria-labelledby="expertise-heading">
        <div class="text-center mb-14">
            <h2 id="expertise-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Areas of Expertise</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Combining traditional software engineering discipline with modern AI-assisted development across the full technology stack.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <article class="bg-white dark:bg-zinc-900 rounded-2xl p-7 border border-gray-200 dark:border-zinc-800 hover:border-purple-300 dark:hover:border-purple-700 transition-colors group">
                    <div class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center mb-5 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/40 transition-colors">
                        <flux:icon name="{{ $service->icon ?? 'code-bracket' }}" class="w-5 h-5 text-purple-700 dark:text-purple-400" aria-hidden="true" />
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $service->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service->description }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Featured Projects --}}
    @if($featuredProjects->isNotEmpty())
        <section class="bg-gray-50 dark:bg-zinc-900/50 py-20" aria-labelledby="projects-heading">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <h2 id="projects-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Featured Projects</h2>
                        <p class="text-gray-600 dark:text-gray-400">Selected work from my professional portfolio.</p>
                    </div>
                    <a href="{{ route('projects.index') }}" class="hidden sm:inline-flex items-center text-sm font-medium text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors">
                        All Projects
                        <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredProjects as $project)
                        <article class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden hover:border-purple-300 dark:hover:border-purple-700 transition-colors flex flex-col group">
                            @if($project->featuredImageUrl())
                                <div class="aspect-video w-full overflow-hidden bg-gray-100 dark:bg-zinc-800">
                                    <img src="{{ $project->featuredImageUrl() }}" alt="{{ $project->name }}" class="w-full h-full object-cover object-[50%_0%] group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                </div>
                            @elseif($project->logoUrl())
                                <div class="aspect-video w-full bg-gradient-to-br from-purple-900/20 to-purple-800/10 flex items-center justify-center">
                                    <img src="{{ $project->logoUrl() }}" alt="{{ $project->name }} logo" class="max-h-20 max-w-[60%] object-contain" loading="lazy">
                                </div>
                            @else
                                <div class="aspect-video w-full bg-gradient-to-br from-purple-900/20 to-purple-800/10 flex items-center justify-center">
                                    <span class="text-3xl font-bold text-purple-700/30 dark:text-purple-400/30">{{ Str::initials($project->name) }}</span>
                                </div>
                            @endif
                            <div class="p-6 flex flex-col flex-1">
                                @if($project->category)
                                    <span class="inline-flex self-start px-2 py-1 text-xs font-medium rounded-full bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400 mb-3">
                                        {{ $project->category->name }}
                                    </span>
                                @endif
                                @if($project->is_demo)
                                    <span class="inline-flex self-start px-2 py-1 text-xs font-medium rounded-full bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400 mb-3 ml-2">
                                        Concept / Demo
                                    </span>
                                @endif
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-lg">{{ $project->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4 flex-1">{{ $project->short_description }}</p>
                                @if($project->technologies->isNotEmpty())
                                    <div class="flex flex-wrap gap-1.5 mb-5">
                                        @foreach($project->technologies->take(4) as $tech)
                                            <span class="px-2 py-0.5 text-xs rounded-md bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300">{{ $tech->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex items-center gap-3 mt-auto">
                                    <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center text-sm font-medium text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors">
                                        View Project
                                        <svg class="w-3.5 h-3.5 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                    </a>
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors" aria-label="{{ $project->name }} on GitHub">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                                        </a>
                                    @endif
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors" aria-label="{{ $project->name }} live application">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="text-center mt-12 sm:hidden">
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 border border-purple-200 dark:border-purple-800 text-purple-700 dark:text-purple-400 font-medium rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                        View All Projects
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Development Philosophy --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20" aria-labelledby="philosophy-heading">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
            <div>
                <h2 id="philosophy-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Controlled AI-Assisted Development</h2>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                    AI coding agents are engineering tools, not autonomous decision-makers. I define the system architecture, coding standards, security requirements and implementation constraints. AI agents follow project-specific rules and approved architectural patterns.
                </p>
                <blockquote class="border-l-4 border-purple-700 pl-5 py-1 my-6">
                    <p class="text-gray-800 dark:text-gray-200 font-medium italic leading-relaxed">
                        "I do not delegate engineering responsibility to AI. I define the architecture, establish the rules, orchestrate the agents, review their work and approve every production change."
                    </p>
                </blockquote>
                <a href="{{ route('about') }}" class="inline-flex items-center text-sm font-medium text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors">
                    Read my full philosophy
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['icon' => 'shield-check', 'title' => 'Security First', 'desc' => 'Every project starts with security requirements defined before a single line of code is written.'],
                    ['icon' => 'rectangle-group', 'title' => 'Architecture Led', 'desc' => 'Architecture, data model and component boundaries are established before implementation.'],
                    ['icon' => 'cpu-chip', 'title' => 'AI Orchestrated', 'desc' => 'AI agents are constrained to approved patterns and their output is always reviewed.'],
                    ['icon' => 'check-badge', 'title' => 'Human Approved', 'desc' => 'All material code changes require my personal review and approval before production.'],
                ] as $principle)
                    <div class="bg-gray-50 dark:bg-zinc-900 rounded-xl p-5 border border-gray-200 dark:border-zinc-800">
                        <flux:icon name="{{ $principle['icon'] }}" class="w-6 h-6 text-purple-700 dark:text-purple-400 mb-3" aria-hidden="true" />
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-1">{{ $principle['title'] }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">{{ $principle['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="bg-purple-900 dark:bg-purple-950 text-white py-20" aria-labelledby="cta-heading">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 id="cta-heading" class="text-3xl font-bold mb-5">Available for New Projects</h2>
            <p class="text-purple-200 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                Whether you need a Laravel application, an AI-enabled platform, DevOps engineering, system architecture or web hosting consulting — let's discuss how I can help.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-3.5 bg-white text-purple-900 font-semibold rounded-xl hover:bg-purple-50 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-purple-900">
                    Get In Touch
                </a>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center px-8 py-3.5 border border-purple-500/60 hover:border-purple-300 text-white font-semibold rounded-xl transition-colors">
                    View Projects
                </a>
            </div>
        </div>
    </section>
</div>

