<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your technical skills grouped by category.</p>
        <button wire:click="openCreate"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors">
            <flux:icon name="plus" class="w-4 h-4" />
            Add Skill
        </button>
    </div>

    {{-- Inline form --}}
    @if($showForm)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-purple-200 dark:border-purple-800 p-7 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">{{ $editingId ? 'Edit Skill' : 'New Skill' }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Skill Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="name"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Category <span class="text-red-500">*</span></label>
                    <select wire:model="skillCategoryId"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">— Select Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('skillCategoryId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Level <span class="text-red-500">*</span></label>
                    <select wire:model="level"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">— Select Level —</option>
                        @foreach($levels as $lvl)
                            <option value="{{ $lvl->value }}">{{ $lvl->label() }}</option>
                        @endforeach
                    </select>
                    @error('level') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Sort Order</label>
                    <input type="number" wire:model="sortOrder"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button wire:click="save"
                    class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors">
                    {{ $editingId ? 'Update Skill' : 'Create Skill' }}
                </button>
                <button wire:click="cancel" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Cancel</button>
            </div>
        </div>
    @endif

    {{-- Skills grouped by category --}}
    @forelse($skillsByCategory as $category)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-800 flex items-center justify-between">
                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $category->skills->count() }} skills</span>
            </div>
            @if($category->skills->isEmpty())
                <p class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">No skills in this category yet.</p>
            @else
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @foreach($category->skills as $skill)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50">
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">{{ $skill->name }}</td>
                                <td class="px-6 py-3">
                                    @php $lvl = $skill->level instanceof \App\Enums\SkillLevel ? $skill->level : \App\Enums\SkillLevel::tryFrom($skill->level) @endphp
                                    @if($lvl)
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $lvl->color() }}">{{ $lvl->label() }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-gray-500 dark:text-gray-400 text-xs">order: {{ $skill->sort_order }}</td>
                                <td class="px-6 py-3 text-right">
                                    <div class="inline-flex items-center gap-3">
                                        <button wire:click="openEdit({{ $skill->id }})" class="text-sm text-purple-700 dark:text-purple-400 hover:underline">Edit</button>
                                        <button wire:click="delete({{ $skill->id }})" wire:confirm="Delete this skill?"
                                            class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 px-6 py-12 text-center">
            <p class="text-gray-500 dark:text-gray-400">No skill categories found. Add categories via the database seeder.</p>
        </div>
    @endforelse
</div>
