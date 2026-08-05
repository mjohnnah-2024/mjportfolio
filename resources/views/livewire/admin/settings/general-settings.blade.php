<div class="max-w-2xl space-y-6">
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
        <div>
            <label for="siteTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Site Title</label>
            <input id="siteTitle" type="text" wire:model.defer="siteTitle"
                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" />
            @error('siteTitle') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="siteTagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tagline</label>
            <input id="siteTagline" type="text" wire:model.defer="siteTagline"
                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors" />
        </div>
        <div>
            <label for="metaDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Default Meta Description</label>
            <textarea id="metaDescription" wire:model.defer="metaDescription" rows="3"
                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors resize-y"
                maxlength="500"></textarea>
        </div>
        <div class="pt-2">
            <button type="submit" class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500">Save Settings</button>
        </div>
    </form>
</div>
