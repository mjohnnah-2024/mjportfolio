<div>
    {{-- Hero --}}
    <section class="bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-6">About <span class="text-purple-400">Me</span></h1>
                <p class="text-lg text-gray-300 leading-relaxed">
                    Full-Stack Laravel Developer, Software Architect and AI-Assisted Development Engineer based in Port Moresby, Papua New Guinea.
                </p>
            </div>
        </div>
    </section>

    {{-- Biography --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20" aria-labelledby="bio-heading">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-14">
            <div class="lg:col-span-2">
                <h2 id="bio-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Professional Biography</h2>
                @if($profile)
                    @foreach(explode("\n\n", $profile->biography ?? '') as $paragraph)
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-5">{{ $paragraph }}</p>
                    @endforeach
                @endif
            </div>
            <div class="space-y-6">
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Contact</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <flux:icon name="envelope" class="w-4 h-4 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <a href="mailto:{{ config('portfolio.email') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-700 dark:hover:text-purple-400 transition-colors break-all">{{ config('portfolio.email') }}</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon name="phone" class="w-4 h-4 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <a href="tel:{{ str_replace(' ', '', config('portfolio.phone')) }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-700 dark:hover:text-purple-400 transition-colors">{{ config('portfolio.phone') }}</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon name="map-pin" class="w-4 h-4 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <span class="text-gray-700 dark:text-gray-300">{{ config('portfolio.location') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon name="clock" class="w-4 h-4 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <span class="text-gray-700 dark:text-gray-300">{{ config('portfolio.years_experience') }}+ years experience</span>
                        </li>
                    </ul>
                    <div class="flex gap-3 mt-5">
                        <a href="{{ config('portfolio.github') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors" aria-label="GitHub profile">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                            GitHub
                        </a>
                        <a href="{{ config('portfolio.linkedin') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors" aria-label="LinkedIn profile">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="block w-full text-center px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>

    {{-- Philosophy --}}
    <section class="bg-gray-50 dark:bg-zinc-900/50 py-20" aria-labelledby="philosophy-heading">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <h2 id="philosophy-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-5">Professional Philosophy</h2>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    I value structured engineering. Every project begins with requirements, architecture and agreed standards — not with writing code.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach([
                    ['icon' => 'document-text', 'title' => 'Requirements First', 'desc' => 'Projects start with clearly defined requirements and acceptance criteria before any design or implementation work begins.'],
                    ['icon' => 'rectangle-group', 'title' => 'Architecture Before Code', 'desc' => 'The data model, module boundaries, API contracts and security design are defined before the first line of code is written.'],
                    ['icon' => 'shield-check', 'title' => 'Security as Standard', 'desc' => 'Security is not an afterthought. Authentication, authorization, input validation and output escaping are core requirements.'],
                    ['icon' => 'beaker', 'title' => 'Tests Are Non-Negotiable', 'desc' => 'Automated testing is a professional obligation, not optional. Tests validate the implementation and protect against regression.'],
                    ['icon' => 'cpu-chip', 'title' => 'AI as an Accelerator', 'desc' => 'AI tools accelerate planning, scaffolding, testing and implementation. They do not replace engineering judgment.'],
                    ['icon' => 'check-badge', 'title' => 'Human Authority', 'desc' => 'Final architectural decisions, security controls and production changes are always human-approved. I take responsibility for the code I ship.'],
                ] as $principle)
                    <article class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-gray-200 dark:border-zinc-800">
                        <flux:icon name="{{ $principle['icon'] }}" class="w-6 h-6 text-purple-700 dark:text-purple-400 mb-4" aria-hidden="true" />
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $principle['title'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $principle['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Skills Matrix --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20" aria-labelledby="skills-heading">
        <div class="text-center mb-14">
            <h2 id="skills-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Technical Skills</h2>
            <p class="text-gray-600 dark:text-gray-400">Grouped by domain with proficiency levels based on real production experience.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($skillCategories as $category)
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                        <flux:icon name="{{ $category->icon ?? 'code-bracket' }}" class="w-5 h-5 text-purple-700 dark:text-purple-400" aria-hidden="true" />
                        {{ $category->name }}
                    </h3>
                    <div class="space-y-3">
                        @foreach($category->skills as $skill)
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-gray-800 dark:text-gray-200">{{ $skill->name }}</span>
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $skill->level->color() }} whitespace-nowrap flex-shrink-0">{{ $skill->level->label() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Experience Timeline --}}
    @if($experiences->isNotEmpty())
        <section class="bg-gray-50 dark:bg-zinc-900/50 py-20" aria-labelledby="experience-heading">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-14">
                    <h2 id="experience-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Experience</h2>
                </div>
                <div class="max-w-3xl mx-auto">
                    <ol class="relative border-l border-purple-200 dark:border-purple-800 space-y-10">
                        @foreach($experiences as $exp)
                            <li class="ml-8">
                                <span class="absolute -left-3.5 flex items-center justify-center w-7 h-7 rounded-full bg-purple-700 ring-4 ring-white dark:ring-zinc-950" aria-hidden="true">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6">
                                    <p class="text-xs text-purple-700 dark:text-purple-400 font-medium mb-1">{{ $exp->dateRange() }}</p>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $exp->title }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $exp->organisation }}@if($exp->location) · {{ $exp->location }}@endif</p>
                                    @if($exp->description)
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mb-3">{{ $exp->description }}</p>
                                    @endif
                                    @if($exp->technologies)
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-3"><span class="font-medium text-gray-700 dark:text-gray-300">Technologies:</span> {{ $exp->technologies }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </section>
    @endif

    {{-- Services --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20" aria-labelledby="services-heading">
        <div class="text-center mb-14">
            <h2 id="services-heading" class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Professional Capabilities</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Available for consulting, contracting and employment opportunities across these disciplines.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <article class="bg-gray-50 dark:bg-zinc-900 rounded-2xl p-6 border border-gray-200 dark:border-zinc-800">
                    <flux:icon name="{{ $service->icon ?? 'code-bracket' }}" class="w-6 h-6 text-purple-700 dark:text-purple-400 mb-4" aria-hidden="true" />
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $service->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service->description }}</p>
                </article>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-3.5 bg-purple-700 hover:bg-purple-800 text-white font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2">
                Discuss Your Project
            </a>
        </div>
    </section>
</div>
