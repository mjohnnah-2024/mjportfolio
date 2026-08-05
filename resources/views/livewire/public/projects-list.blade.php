<div>
    {{-- Header --}}
    <div class="bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-4">Projects</h1>
            <p class="text-gray-300 text-lg max-w-2xl">A curated selection of client and personal projects covering enterprise systems, web platforms, and AI-integrated applications.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        {{-- Filters --}}
        <div class="flex flex-wrap gap-4 mb-10 items-end" role="search" aria-label="Filter projects">
            <div class="flex-1 min-w-48">
                <label for="search-projects" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input
                    id="search-projects"
                    type="search"
                    wire:model.live.debounce.400ms="search"
                    placeholder="Search projects…"
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                    aria-label="Search projects"
                />
            </div>
            <div class="min-w-40">
                <label for="filter-category" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select
                    id="filter-category"
                    wire:model.live="selectedCategory"
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                    aria-label="Filter by category"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-40">
                <label for="filter-technology" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Technology</label>
                <select
                    id="filter-technology"
                    wire:model.live="selectedTechnology"
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                    aria-label="Filter by technology"
                >
                    <option value="">All Technologies</option>
                    @foreach($technologies as $tech)
                        <option value="{{ $tech->slug }}">{{ $tech->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($search || $selectedCategory || $selectedTechnology)
                <button
                    wire:click="clearFilters"
                    class="px-4 py-2.5 text-sm text-purple-700 dark:text-purple-400 border border-purple-300 dark:border-purple-700 rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors"
                >Clear filters</button>
            @endif
        </div>

        {{-- Results --}}
        <div wire:loading.class="opacity-60" wire:target="search,selectedCategory,selectedTechnology,clearFilters" class="transition-opacity duration-200">
            @if($projects->isEmpty())
                <div class="text-center py-20">
                    <flux:icon name="folder-open" class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-4" aria-hidden="true" />
                    <p class="text-gray-500 dark:text-gray-400">No projects found matching your filters.</p>
                    <button wire:click="clearFilters" class="mt-4 text-purple-700 dark:text-purple-400 text-sm hover:underline">Clear all filters</button>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7" role="list" aria-label="Projects">
                    @foreach($projects as $project)
                        <article class="group bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden flex flex-col hover:shadow-lg transition-shadow" role="listitem">
                            @if($project->featuredImageUrl())
                                <img
                                    src="{{ $project->featuredImageUrl() }}"
                                    alt="{{ $project->name }} screenshot"
                                    class="w-full h-48 object-cover"
                                    loading="lazy"
                                />
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-800 to-purple-950 flex items-center justify-center" aria-hidden="true">
                                    <flux:icon name="code-bracket-square" class="w-14 h-14 text-purple-400/60" />
                                </div>
                            @endif
                            <div class="flex flex-col flex-1 p-6">
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <h2 class="font-semibold text-gray-900 dark:text-white leading-snug">{{ $project->name }}</h2>
                                    @if($project->is_featured)
                                        <flux:badge color="purple" size="sm" class="flex-shrink-0">Featured</flux:badge>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed flex-1 line-clamp-3">{{ $project->short_description }}</p>
                                @if($project->technologies->isNotEmpty())
                                    <div class="flex flex-wrap gap-1.5 mt-4" aria-label="Technologies used">
                                        @foreach($project->technologies->take(5) as $tech)
                                            <span class="inline-flex px-2 py-0.5 text-xs rounded-full bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-gray-400">{{ $tech->name }}</span>
                                        @endforeach
                                        @if($project->technologies->count() > 5)
                                            <span class="inline-flex px-2 py-0.5 text-xs rounded-full bg-gray-100 dark:bg-zinc-800 text-gray-500 dark:text-gray-500">+{{ $project->technologies->count() - 5 }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="flex items-center justify-between mt-5">
                                    <a
                                        href="{{ route('projects.show', $project->slug) }}"
                                        class="text-sm font-medium text-purple-700 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 transition-colors group-hover:underline"
                                        aria-label="View {{ $project->name }} details"
                                    >View details →</a>
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors" aria-label="Live demo of {{ $project->name }}">Live demo ↗</a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($projects->hasPages())
                    <div class="mt-10" aria-label="Pagination">
                        {{ $projects->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
