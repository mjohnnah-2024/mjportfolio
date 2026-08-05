<div class="max-w-3xl space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
            <flux:icon name="arrow-left" class="w-4 h-4" />
            Back to Messages
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
        {{-- Header --}}
        <div class="px-7 py-5 border-b border-gray-200 dark:border-zinc-800">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $message->subject }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        From <span class="font-medium text-gray-700 dark:text-gray-200">{{ $message->name }}</span>
                        @if($message->organisation)
                            · {{ $message->organisation }}
                        @endif
                    </p>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                    {{ $message->is_read ? 'bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-gray-400' : 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400' }}">
                    {{ $message->is_read ? 'Read' : 'Unread' }}
                </span>
            </div>
        </div>

        {{-- Meta --}}
        <div class="px-7 py-4 bg-gray-50 dark:bg-zinc-900/50 border-b border-gray-200 dark:border-zinc-800 grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider mb-0.5">Email</p>
                <a href="mailto:{{ $message->email }}" class="text-purple-700 dark:text-purple-400 hover:underline">{{ $message->email }}</a>
            </div>
            @if($message->phone)
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider mb-0.5">Phone</p>
                    <a href="tel:{{ $message->phone }}" class="text-gray-900 dark:text-gray-100">{{ $message->phone }}</a>
                </div>
            @endif
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider mb-0.5">Type</p>
                <p class="text-gray-900 dark:text-gray-100">{{ $message->enquiry_type instanceof \App\Enums\EnquiryType ? $message->enquiry_type->label() : ucwords(str_replace('_', ' ', $message->enquiry_type)) }}</p>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider mb-0.5">Received</p>
                <p class="text-gray-900 dark:text-gray-100">{{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-7 py-6">
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
        </div>

        {{-- Actions --}}
        <div class="px-7 py-4 border-t border-gray-200 dark:border-zinc-800 flex items-center gap-4">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition-colors">
                <flux:icon name="envelope" class="w-4 h-4" />
                Reply via Email
            </a>
            <button wire:click="delete" wire:confirm="Delete this message permanently?"
                class="inline-flex items-center gap-2 px-5 py-2.5 border border-red-300 dark:border-red-700 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 text-sm font-medium rounded-xl transition-colors">
                <flux:icon name="trash" class="w-4 h-4" />
                Delete
            </button>
        </div>
    </div>
</div>
