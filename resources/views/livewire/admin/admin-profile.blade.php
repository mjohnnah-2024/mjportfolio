<div class="max-w-2xl space-y-6">
    {{-- Profile Info --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Profile Information</h2>

        @if(session('profileSuccess'))
            <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
                {{ session('profileSuccess') }}
            </div>
        @endif

        <form wire:submit.prevent="updateProfile" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Full Name</label>
                    <input id="name" type="text" wire:model="name"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('name') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email Address</label>
                    <input id="email" type="email" wire:model="email"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('email') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Phone Number</label>
                    <input id="phone" type="tel" wire:model="phone" placeholder="+675 7451 1108"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('phone') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Location</label>
                    <input id="location" type="text" wire:model="location" placeholder="Port Moresby, Papua New Guinea"
                        class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                    @error('location') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="headline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Professional Headline</label>
                <input id="headline" type="text" wire:model="headline" maxlength="500"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                @error('headline') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>

            {{-- Social Links --}}
            <div class="pt-2 border-t border-gray-100 dark:border-zinc-800">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Social Links</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="github" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                                GitHub
                            </span>
                        </label>
                        <input id="github" type="url" wire:model="github" placeholder="https://github.com/username"
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                        @error('github') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="linkedin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </span>
                        </label>
                        <input id="linkedin" type="url" wire:model="linkedin" placeholder="https://linkedin.com/in/username"
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                        @error('linkedin') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500">Update Profile</button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-7 space-y-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Change Password</h2>

        @if(session('passwordSuccess'))
            <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 rounded-xl px-4 py-3 text-sm text-green-800 dark:text-green-300" role="alert">
                {{ session('passwordSuccess') }}
            </div>
        @endif

        <form wire:submit.prevent="updatePassword" class="space-y-5">
            <div>
                <label for="currentPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Current Password</label>
                <input id="currentPassword" type="password" wire:model="currentPassword"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                @error('currentPassword') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="newPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">New Password</label>
                <input id="newPassword" type="password" wire:model="newPassword"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                @error('newPassword') <p class="mt-1 text-xs text-red-600" role="alert">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="newPasswordConfirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Confirm New Password</label>
                <input id="newPasswordConfirmation" type="password" wire:model="newPasswordConfirmation"
                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500">Change Password</button>
            </div>
        </form>
    </div>
</div>
