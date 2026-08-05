<div class="space-y-6">
    {{-- Filters --}}
    <div class="flex gap-2" role="tablist" aria-label="Filter messages">
        @foreach(['all' => 'All', 'unread' => 'Unread', 'read' => 'Read'] as $value => $label)
            <button
                wire:click="$set('filter', '{{ $value }}')"
                role="tab"
                aria-selected="{{ $filter === $value ? 'true' : 'false' }}"
                class="px-4 py-2 text-sm font-medium rounded-xl transition-colors
                    {{ $filter === $value
                        ? 'bg-purple-700 text-white'
                        : 'bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 text-gray-700 dark:text-gray-300 hover:border-purple-300 dark:hover:border-purple-700' }}"
            >{{ $label }}</button>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
        @if($messages->isEmpty())
            <div class="text-center py-16">
                <flux:icon name="inbox" class="w-10 h-10 text-gray-300 dark:text-gray-600 mx-auto mb-3" aria-hidden="true" />
                <p class="text-gray-500 dark:text-gray-400 text-sm">No messages found.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm" aria-label="Contact messages">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-zinc-800 text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <th class="text-left px-6 py-4 font-medium">From</th>
                            <th class="text-left px-6 py-4 font-medium">Subject</th>
                            <th class="text-left px-6 py-4 font-medium">Type</th>
                            <th class="text-left px-6 py-4 font-medium">Received</th>
                            <th class="text-left px-6 py-4 font-medium">Status</th>
                            <th class="text-left px-6 py-4 font-medium sr-only">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @foreach($messages as $message)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors {{ is_null($message->read_at) ? 'font-medium' : '' }}">
                                <td class="px-6 py-4">
                                    <p class="text-gray-900 dark:text-white">{{ $message->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $message->email }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 max-w-xs truncate">{{ $message->subject }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $message->enquiry_type?->label() }}</td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $message->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if(is_null($message->read_at))
                                        <flux:badge color="amber" size="sm">Unread</flux:badge>
                                    @else
                                        <flux:badge color="zinc" size="sm">Read</flux:badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.messages.show', $message) }}" class="text-purple-700 dark:text-purple-400 hover:underline text-xs">View</a>
                                        @if(is_null($message->read_at))
                                            <button wire:click="markRead({{ $message->id }})" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-xs">Mark read</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($messages->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-zinc-800">
                    {{ $messages->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
