<div class="max-w-3xl space-y-6">
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
            <flux:icon name="arrow-left" class="w-4 h-4" />
            Back to Projects
        </a>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        {{-- Basic Info --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Project Name <span class="text-red-500">*</span></label>
                    <input id="name" type="text" wire:model.live="name"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('name') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Slug <span class="text-red-500">*</span></label>
                    <input id="slug" type="text" wire:model="slug"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent font-mono" />
                    @error('slug') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="shortDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Short Description</label>
                <textarea id="shortDescription" wire:model="shortDescription" rows="2"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-y"
                    maxlength="500"></textarea>
                @error('shortDescription') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="fullDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Full Description</label>
                <textarea id="fullDescription" wire:model="fullDescription" rows="5"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-y font-mono text-xs"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="challenge" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Challenge</label>
                    <textarea id="challenge" wire:model="challenge" rows="3"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-y"></textarea>
                </div>
                <div>
                    <label for="solution" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Solution</label>
                    <textarea id="solution" wire:model="solution" rows="3"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-y"></textarea>
                </div>
            </div>
        </div>

        {{-- Project Details --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Project Details</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="projectCategoryId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Category</label>
                    <select id="projectCategoryId" wire:model="projectCategoryId"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">— Select Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select id="status" wire:model="status"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Client</label>
                    <input id="client" type="text" wire:model="client"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Flags</label>
                    <div class="flex gap-6 pt-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="isFeatured" class="rounded border-gray-300 text-purple-700 focus:ring-purple-500" />
                            <span class="text-sm text-gray-700 dark:text-gray-300">Featured</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="isDemo" class="rounded border-gray-300 text-purple-700 focus:ring-purple-500" />
                            <span class="text-sm text-gray-700 dark:text-gray-300">Demo</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Start Date</label>
                    <input id="startDate" type="date" wire:model="startDate"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                </div>
                <div>
                    <label for="completionDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Completion Date</label>
                    <input id="completionDate" type="date" wire:model="completionDate"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="githubUrl" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">GitHub URL</label>
                    <input id="githubUrl" type="url" wire:model="githubUrl" placeholder="https://github.com/..."
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('githubUrl') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="liveUrl" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Live URL</label>
                    <input id="liveUrl" type="url" wire:model="liveUrl" placeholder="https://..."
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('liveUrl') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">SEO</h2>
            <div>
                <label for="seoTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">SEO Title</label>
                <input id="seoTitle" type="text" wire:model="seoTitle" maxlength="255"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
            </div>
            <div>
                <label for="seoDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">SEO Description</label>
                <textarea id="seoDescription" wire:model="seoDescription" rows="2" maxlength="500"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-y"></textarea>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500"
                wire:loading.attr="disabled" wire:loading.class="opacity-60">
                <span wire:loading.remove>{{ $isEditing ? 'Update Project' : 'Create Project' }}</span>
                <span wire:loading>Saving…</span>
            </button>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Cancel</a>
        </div>
    </form>
</div>
