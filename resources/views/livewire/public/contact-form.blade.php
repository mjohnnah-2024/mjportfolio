<div>
    {{-- Header --}}
    <div class="bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-16">
        <div class="max-w-3xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-4">Get In Touch</h1>
            <p class="text-gray-300 text-lg">Available for employment, consulting and project-based engagements. Let's talk.</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Sidebar --}}
            <aside class="space-y-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Contact Information</h2>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <flux:icon name="envelope" class="w-5 h-5 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Email</p>
                                <a href="mailto:{{ config('portfolio.email') }}" class="text-purple-700 dark:text-purple-400 hover:underline break-all">{{ config('portfolio.email') }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon name="phone" class="w-5 h-5 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Phone / WhatsApp</p>
                                <a href="tel:{{ str_replace(' ', '', config('portfolio.phone')) }}" class="text-purple-700 dark:text-purple-400 hover:underline">{{ config('portfolio.phone') }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <flux:icon name="map-pin" class="w-5 h-5 text-purple-700 dark:text-purple-400 mt-0.5 flex-shrink-0" aria-hidden="true" />
                            <div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Location</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ config('portfolio.location') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/10 border border-purple-200 dark:border-purple-800 rounded-2xl p-5">
                    <p class="text-sm text-purple-800 dark:text-purple-300 font-medium mb-1">Response Time</p>
                    <p class="text-sm text-purple-700 dark:text-purple-400">I typically respond within 24 hours on business days.</p>
                </div>
            </aside>

            {{-- Form --}}
            <div class="lg:col-span-2">
                {{-- Error banner --}}
                @if($errorMessage)
                    <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-2xl p-5 mb-6 flex items-start gap-3" role="alert">
                        <flux:icon name="exclamation-circle" class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" aria-hidden="true" />
                        <p class="text-sm text-red-700 dark:text-red-400">{{ $errorMessage }}</p>
                    </div>
                @endif

                {{-- Success state — shown after submission --}}
                @if($submitted)
                    <div class="bg-gradient-to-br from-purple-50 to-green-50 dark:from-purple-900/10 dark:to-green-900/10 border border-green-200 dark:border-green-800 rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mx-auto mb-5">
                            <flux:icon name="check-circle" class="w-8 h-8 text-green-600 dark:text-green-400" aria-hidden="true" />
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Message Sent!</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                            Thank you for reaching out. Your message has been received and I will get back to you as soon as possible — usually within 24 hours on business days.
                        </p>
                        <button
                            type="button"
                            wire:click="resetForm"
                            class="inline-flex items-center gap-2 px-6 py-2.5 border border-purple-300 dark:border-purple-700 text-purple-700 dark:text-purple-400 text-sm font-medium rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500"
                        >
                            Send Another Message
                        </button>
                    </div>
                @else
                {{-- Validation error banner --}}
                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-2xl p-4 mb-6" role="alert">
                        <p class="text-sm font-medium text-red-800 dark:text-red-300 mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700 dark:text-red-400">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form wire:submit.prevent="submit" novalidate class="space-y-6">
                    {{-- Honeypot --}}
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" wire:model="website" tabindex="-1" autocomplete="off" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Full Name <span class="text-red-500" aria-label="required">*</span></label>
                            <input
                                id="name"
                                type="text"
                                wire:model.defer="name"
                                autocomplete="name"
                                required
                                class="w-full px-4 py-3 text-sm rounded-xl border @error('name') border-red-400 dark:border-red-600 bg-red-50 dark:bg-red-900/10 @else border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 @enderror text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                aria-describedby="name-error"
                            />
                            @error('name')
                                <p id="name-error" class="mt-1 text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email Address <span class="text-red-500" aria-label="required">*</span></label>
                            <input
                                id="email"
                                type="email"
                                wire:model.defer="email"
                                autocomplete="email"
                                required
                                class="w-full px-4 py-3 text-sm rounded-xl border @error('email') border-red-400 dark:border-red-600 bg-red-50 dark:bg-red-900/10 @else border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 @enderror text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                aria-describedby="email-error"
                            />
                            @error('email')
                                <p id="email-error" class="mt-1 text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Phone (optional)</label>
                            <input
                                id="phone"
                                type="tel"
                                wire:model.defer="phone"
                                autocomplete="tel"
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                            />
                        </div>
                        <div>
                            <label for="organisation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Organisation (optional)</label>
                            <input
                                id="organisation"
                                type="text"
                                wire:model.defer="organisation"
                                autocomplete="organization"
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="enquiry_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Enquiry Type <span class="text-red-500" aria-label="required">*</span></label>
                        <select
                            id="enquiry_type"
                            wire:model.defer="enquiryType"
                            required
                            class="w-full px-4 py-3 text-sm rounded-xl border @error('enquiry_type') border-red-400 dark:border-red-600 bg-red-50 dark:bg-red-900/10 @else border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 @enderror text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                            aria-describedby="enquiry-error"
                        >
                            <option value="">Select type of enquiry…</option>
                            @foreach(\App\Enums\EnquiryType::cases() as $type)
                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                            @endforeach
                        </select>
                        @error('enquiry_type')
                            <p id="enquiry-error" class="mt-1 text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Subject <span class="text-red-500" aria-label="required">*</span></label>
                        <input
                            id="subject"
                            type="text"
                            wire:model.defer="subject"
                            required
                            class="w-full px-4 py-3 text-sm rounded-xl border @error('subject') border-red-400 dark:border-red-600 bg-red-50 dark:bg-red-900/10 @else border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 @enderror text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                            aria-describedby="subject-error"
                        />
                        @error('subject')
                            <p id="subject-error" class="mt-1 text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Message <span class="text-red-500" aria-label="required">*</span></label>
                        <textarea
                            id="message"
                            wire:model.defer="message"
                            rows="6"
                            required
                            class="w-full px-4 py-3 text-sm rounded-xl border @error('message') border-red-400 dark:border-red-600 bg-red-50 dark:bg-red-900/10 @else border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 @enderror text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors resize-y"
                            aria-describedby="message-error"
                            placeholder="Describe your project, requirement or question…"
                        ></textarea>
                        @error('message')
                            <p id="message-error" class="mt-1 text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start gap-3">
                        <input
                            type="checkbox"
                            id="consent"
                            wire:model.defer="consent"
                            required
                            class="mt-1 w-4 h-4 rounded border-gray-300 text-purple-700 focus:ring-purple-500"
                            aria-describedby="consent-error"
                        />
                        <label for="consent" class="text-sm text-gray-600 dark:text-gray-400">
                            I consent to Mark Johnnah processing my information to respond to this enquiry. My details will not be shared with third parties.
                        </label>
                    </div>
                    @error('consent')
                        <p id="consent-error" class="text-xs text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-purple-700 hover:bg-purple-800 disabled:bg-purple-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2"
                    >
                        <span wire:loading.remove wire:target="submit">Send Message</span>
                        <span wire:loading wire:target="submit" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            Sending…
                        </span>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
