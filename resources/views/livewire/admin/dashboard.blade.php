<div class="space-y-8">
    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5" role="list" aria-label="Dashboard statistics">
        @foreach([
            ['label' => 'Total Projects', 'value' => $totalProjects, 'icon' => 'folder', 'color' => 'purple'],
            ['label' => 'Published', 'value' => $publishedProjects, 'icon' => 'globe-alt', 'color' => 'green'],
            ['label' => 'Total Messages', 'value' => $totalMessages, 'icon' => 'envelope', 'color' => 'blue'],
            ['label' => 'Unread', 'value' => $unreadMessages, 'icon' => 'bell-alert', 'color' => 'amber'],
        ] as $stat)
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-5" role="listitem">
                <flux:icon name="{{ $stat['icon'] }}" class="w-5 h-5 text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400 mb-3" aria-hidden="true" />
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Quick links --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-5 hover:border-purple-300 dark:hover:border-purple-700 transition-colors group">
            <flux:icon name="plus-circle" class="w-6 h-6 text-purple-700 dark:text-purple-400" aria-hidden="true" />
            <span class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-purple-700 dark:group-hover:text-purple-400 transition-colors">Manage Projects</span>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-5 hover:border-purple-300 dark:hover:border-purple-700 transition-colors group">
            <flux:icon name="inbox" class="w-6 h-6 text-purple-700 dark:text-purple-400" aria-hidden="true" />
            <span class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-purple-700 dark:group-hover:text-purple-400 transition-colors">View Messages</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-5 hover:border-purple-300 dark:hover:border-purple-700 transition-colors group">
            <flux:icon name="arrow-top-right-on-square" class="w-6 h-6 text-purple-700 dark:text-purple-400" aria-hidden="true" />
            <span class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-purple-700 dark:group-hover:text-purple-400 transition-colors">View Portfolio</span>
        </a>
    </div>

    {{-- Recent messages --}}
    @if($recentMessages->isNotEmpty())
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 dark:border-zinc-800">
                <h2 class="font-semibold text-gray-900 dark:text-white">Unread Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-sm text-purple-700 dark:text-purple-400 hover:underline">View all</a>
            </div>
            <ul role="list" class="divide-y divide-gray-100 dark:divide-zinc-800">
                @foreach($recentMessages as $msg)
                    <li class="px-6 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <p class="font-medium text-gray-900 dark:text-white text-sm truncate">{{ $msg->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ $msg->subject }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $msg->created_at->diffForHumans() }}</p>
                            </div>
                            <flux:badge color="amber" size="sm" class="flex-shrink-0">Unread</flux:badge>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
