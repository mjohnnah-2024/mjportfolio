<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between gap-4">
        <input
            type="search"
            wire:model.live.debounce.400ms="search"
            placeholder="Search projects…"
            class="px-4 py-2.5 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors w-64"
            aria-label="Search projects"
        />
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-xl transition-colors">
            <flux:icon name="plus" class="w-4 h-4" aria-hidden="true" />
            New Project
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
        @if($projects->isEmpty())
            <div class="text-center py-16">
                <flux:icon name="folder-open" class="w-10 h-10 text-gray-300 dark:text-gray-600 mx-auto mb-3" aria-hidden="true" />
                <p class="text-gray-500 dark:text-gray-400 text-sm">No projects found.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm" aria-label="Projects">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-zinc-800 text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <th class="text-left px-6 py-4 font-medium">Project</th>
                            <th class="text-left px-6 py-4 font-medium">Category</th>
                            <th class="text-left px-6 py-4 font-medium">Status</th>
                            <th class="text-left px-6 py-4 font-medium">Featured</th>
                            <th class="text-left px-6 py-4 font-medium sr-only">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @foreach($projects as $project)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $project->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $project->slug }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $project->category?->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if($project->trashed())
                                        <flux:badge color="red" size="sm">Deleted</flux:badge>
                                    @else
                                        <flux:badge color="{{ $project->status === 'published' ? 'green' : 'zinc' }}" size="sm">{{ ucfirst($project->status) }}</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->is_featured)
                                        <flux:icon name="star" class="w-4 h-4 text-amber-500" aria-label="Featured" />
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600" aria-hidden="true">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-purple-700 dark:text-purple-400 hover:underline text-xs">Edit</a>
                                        @if(!$project->trashed())
                                            <button
                                                wire:click="delete({{ $project->id }})"
                                                wire:confirm="Delete '{{ $project->name }}'? This can be recovered."
                                                class="text-red-600 dark:text-red-400 hover:underline text-xs"
                                            >Delete</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($projects->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-zinc-800">
                    {{ $projects->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
