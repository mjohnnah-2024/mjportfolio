<div>
    {{-- Hero --}}
    <div class="bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-16">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="text-sm mb-6">
                <ol class="flex items-center gap-2 text-gray-400">
                    <li><a href="{{ route('projects.index') }}" class="hover:text-purple-400 transition-colors">Projects</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">{{ $project->name }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-bold mb-4">{{ $project->name }}</h1>
            @if($project->short_description)
                <p class="text-xl text-purple-200 mb-6">{{ $project->short_description }}</p>
            @endif
            <div class="flex flex-wrap gap-3">
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-700 hover:bg-purple-600 text-white font-medium rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-400">
                        <flux:icon name="arrow-top-right-on-square" class="w-4 h-4" aria-hidden="true" />
                        Live Demo
                    </a>
                @endif
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-medium rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                        Source Code
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Featured Image --}}
    @if($project->featuredImageUrl())
        <div class="max-w-5xl mx-auto px-6 lg:px-8 -mt-6">
            <div class="rounded-2xl overflow-hidden border border-white/10 shadow-2xl shadow-purple-950/30">
                <img
                    src="{{ $project->featuredImageUrl() }}"
                    alt="{{ $project->name }}"
                    class="w-full max-h-[480px] object-cover"
                    loading="eager"
                >
            </div>
        </div>
    @elseif($project->logoUrl())
        <div class="max-w-5xl mx-auto px-6 lg:px-8 -mt-6">
            <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 flex items-center justify-center py-14">
                <img
                    src="{{ $project->logoUrl() }}"
                    alt="{{ $project->name }} logo"
                    class="max-h-32 max-w-sm object-contain"
                    loading="eager"
                >
            </div>
        </div>
    @endif

    <div class="max-w-5xl mx-auto px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Main content --}}
            <div class="lg:col-span-2 space-y-10">
                @if($project->full_description)
                    <section aria-labelledby="overview-heading">
                        <h2 id="overview-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Overview</h2>
                        <div class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg prose dark:prose-invert max-w-none">{!! Str::markdown(e($project->full_description)) !!}</div>
                    </section>
                @endif

                @if($project->challenge)
                    <section aria-labelledby="challenge-heading">
                        <h2 id="challenge-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-4">The Challenge</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $project->challenge }}</p>
                    </section>
                @endif

                @if($project->solution)
                    <section aria-labelledby="solution-heading">
                        <h2 id="solution-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-4">The Solution</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $project->solution }}</p>
                    </section>
                @endif

                @if($project->key_features)
                    <section aria-labelledby="features-heading">
                        <h2 id="features-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Key Features</h2>
                        <ul class="space-y-2">
                            @foreach((is_array($project->key_features) ? $project->key_features : json_decode($project->key_features, true) ?? []) as $feature)
                                <li class="flex items-start gap-3 text-gray-700 dark:text-gray-300">
                                    <flux:icon name="check-circle" class="w-5 h-5 text-purple-700 dark:text-purple-400 flex-shrink-0 mt-0.5" aria-hidden="true" />
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{-- Screenshots --}}
                @if($project->media->isNotEmpty())
                    <section aria-labelledby="screenshots-heading">
                        <h2 id="screenshots-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Screenshots</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($project->media as $media)
                                <figure>
                                    <img
                                        src="{{ $media->url() }}"
                                        alt="{{ $media->alt_text ?: $project->name . ' screenshot' }}"
                                        class="w-full rounded-xl border border-gray-200 dark:border-zinc-800 object-cover"
                                        loading="lazy"
                                    />
                                    @if($media->caption)
                                        <figcaption class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">{{ $media->caption }}</figcaption>
                                    @endif
                                </figure>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6" aria-label="Project details">
                @if($project->logoUrl() && !$project->featuredImageUrl())
                    <div class="bg-gray-50 dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6 flex items-center justify-center">
                        <img src="{{ $project->logoUrl() }}" alt="{{ $project->name }} logo" class="max-h-20 max-w-full object-contain">
                    </div>
                @endif
                <div class="bg-gray-50 dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Project Info</h3>
                    <dl class="space-y-3 text-sm">
                        @if($project->category)
                            <div class="flex justify-between gap-2">
                                <dt class="text-gray-500 dark:text-gray-400">Category</dt>
                                <dd class="text-gray-900 dark:text-white text-right">{{ $project->category->name }}</dd>
                            </div>
                        @endif
                        @if($project->start_date)
                            <div class="flex justify-between gap-2">
                                <dt class="text-gray-500 dark:text-gray-400">Started</dt>
                                <dd class="text-gray-900 dark:text-white">{{ $project->start_date->format('M Y') }}</dd>
                            </div>
                        @endif
                        @if($project->completion_date)
                            <div class="flex justify-between gap-2">
                                <dt class="text-gray-500 dark:text-gray-400">Completed</dt>
                                <dd class="text-gray-900 dark:text-white">{{ $project->completion_date->format('M Y') }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                @if($project->technologies->isNotEmpty())
                    <div class="bg-gray-50 dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Tech Stack</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies as $tech)
                                <span class="inline-flex px-3 py-1 text-xs rounded-full bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400 border border-purple-200 dark:border-purple-800">{{ $tech->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <a href="{{ route('contact') }}" class="block w-full text-center px-6 py-3 bg-purple-700 hover:bg-purple-800 text-white font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500">
                    Discuss a Similar Project
                </a>
            </aside>
        </div>

        {{-- Related projects --}}
        @if($relatedProjects->isNotEmpty())
            <section class="mt-20" aria-labelledby="related-heading">
                <h2 id="related-heading" class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Projects</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProjects as $relatedProject)
                        <article class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-5 hover:shadow-md transition-shadow">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ $relatedProject->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-4">{{ $relatedProject->short_description }}</p>
                            <a href="{{ route('projects.show', $relatedProject->slug) }}" class="text-sm text-purple-700 dark:text-purple-400 hover:underline">View project →</a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
