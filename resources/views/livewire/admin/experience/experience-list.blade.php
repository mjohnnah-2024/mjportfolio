<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your work history and experience.</p>
        <button wire:click="openCreate"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors">
            <flux:icon name="plus" class="w-4 h-4" />
            Add Experience
        </button>
    </div>

    {{-- Inline form --}}
    @if($showForm)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-purple-200 dark:border-purple-800 p-7 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">{{ $editingId ? 'Edit Experience' : 'New Experience' }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="title"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Organisation <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="organisation"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    @error('organisation') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Location</label>
                    <input type="text" wire:model="location"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Sort Order</label>
                    <input type="number" wire:model="sortOrder"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Start Date <span class="text-red-500">*</span></label>
                    <input type="date" wire:model="startDate"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    @error('startDate') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">End Date</label>
                    <input type="date" wire:model="endDate" :disabled="$isCurrent"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 disabled:opacity-50" />
                    <label class="flex items-center gap-2 mt-2 cursor-pointer">
                        <input type="checkbox" wire:model="isCurrent" class="rounded border-gray-300 text-purple-700 focus:ring-purple-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Currently working here</span>
                    </label>
                    @error('endDate') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Description</label>
                <textarea wire:model="description" rows="4"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 resize-y"></textarea>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button wire:click="save"
                    class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors">
                    {{ $editingId ? 'Update Experience' : 'Create Experience' }}
                </button>
                <button wire:click="cancel" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Cancel</button>
            </div>
        </div>
    @endif

    {{-- Experience list --}}
    @forelse($experiences as $exp)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $exp->title }}</h3>
                        @if($exp->is_current)
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">Current</span>
                        @endif
                    </div>
                    <p class="text-sm text-purple-700 dark:text-purple-400 mt-0.5">{{ $exp->organisation }}@if($exp->location) · {{ $exp->location }}@endif</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $exp->start_date?->format('M Y') }} — {{ $exp->is_current ? 'Present' : ($exp->end_date?->format('M Y') ?? '—') }}
                    </p>
                    @if($exp->description)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">{{ $exp->description }}</p>
                    @endif
                </div>
                <div class="inline-flex items-center gap-3 flex-shrink-0">
                    <button wire:click="openEdit({{ $exp->id }})" class="text-sm text-purple-700 dark:text-purple-400 hover:underline">Edit</button>
                    <button wire:click="delete({{ $exp->id }})" wire:confirm="Delete this experience entry?"
                        class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 px-6 py-12 text-center">
            <p class="text-gray-500 dark:text-gray-400">No experience entries yet. Add your first one above.</p>
        </div>
    @endforelse
</div>
