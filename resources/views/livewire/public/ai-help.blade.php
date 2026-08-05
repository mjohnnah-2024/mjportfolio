<div
    x-data="{ autoScroll: true }"
    x-init="
        $watch('$wire.chatHistory', () => {
            if (autoScroll) {
                $nextTick(() => {
                    const el = document.getElementById('chat-messages');
                    if (el) el.scrollTop = el.scrollHeight;
                });
            }
        });
    "
    @scroll-to-bottom.window="
        $nextTick(() => {
            const el = document.getElementById('chat-messages');
            if (el) el.scrollTop = el.scrollHeight;
        });
    "
>
    {{-- Page Header --}}
    <div class="bg-gradient-to-br from-zinc-950 via-purple-950 to-zinc-950 text-white py-16">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-purple-700/50 border border-purple-500/30 mb-6" aria-hidden="true">
                <svg class="w-7 h-7 text-purple-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold mb-4">AI Technical Help</h1>
            <p class="text-purple-200 text-lg leading-relaxed max-w-2xl mx-auto">
                Ask questions about web development, web hosting, DevOps, software architecture, cloud infrastructure and any IT topic. I'll provide accurate, practical answers.
            </p>
        </div>
    </div>

    {{-- Topics Banner --}}
    <div class="bg-white dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-800">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 py-4">
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Topics:</span>
                @foreach(['Laravel / PHP', '.NET', 'Node.js', 'Web Hosting', 'DevOps', 'Linux', 'Docker', 'SQL', 'APIs', 'Architecture', 'AI / LLMs', 'DNS & SSL'] as $topic)
                    <span class="inline-flex px-2.5 py-1 text-xs rounded-full bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400 border border-purple-200 dark:border-purple-800">{{ $topic }}</span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Chat Container --}}
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 overflow-hidden shadow-sm flex flex-col" style="height: calc(100vh - 22rem); min-height: 480px;">

            {{-- Chat header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-800/50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-purple-700 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-sm text-gray-900 dark:text-white">Tech Help Assistant</p>
                        <p class="text-xs text-green-600 dark:text-green-400 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block" aria-hidden="true"></span>
                            Online — IT & web development topics
                        </p>
                    </div>
                </div>
                @if(count($chatHistory) > 0)
                    <button
                        wire:click="clearConversation"
                        class="text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors flex items-center gap-1"
                        aria-label="Clear conversation"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        Clear
                    </button>
                @endif
            </div>

            {{-- Messages --}}
            <div
                id="chat-messages"
                class="flex-1 overflow-y-auto p-5 space-y-5"
                aria-live="polite"
                aria-label="Chat messages"
                @scroll="autoScroll = ($el.scrollTop + $el.clientHeight >= $el.scrollHeight - 50)"
            >
                {{-- Welcome message --}}
                @if(empty($chatHistory))
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-purple-700 flex items-center justify-center flex-shrink-0 mt-0.5" aria-hidden="true">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
                        </div>
                        <div class="bg-gray-100 dark:bg-zinc-800 rounded-2xl rounded-tl-sm px-4 py-3 max-w-lg">
                            <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed">Hello! I'm your IT and web development assistant. I can help you with:</p>
                            <ul class="mt-2 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                                <li class="flex items-start gap-2"><span class="text-purple-600 mt-0.5" aria-hidden="true">•</span> Web development (Laravel, PHP, .NET, Node.js)</li>
                                <li class="flex items-start gap-2"><span class="text-purple-600 mt-0.5" aria-hidden="true">•</span> Web hosting, DNS, cPanel, SSL</li>
                                <li class="flex items-start gap-2"><span class="text-purple-600 mt-0.5" aria-hidden="true">•</span> DevOps, Linux, Docker, CI/CD</li>
                                <li class="flex items-start gap-2"><span class="text-purple-600 mt-0.5" aria-hidden="true">•</span> Software architecture and design</li>
                                <li class="flex items-start gap-2"><span class="text-purple-600 mt-0.5" aria-hidden="true">•</span> AI-assisted development and LLMs</li>
                            </ul>
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">What would you like help with today?</p>
                        </div>
                    </div>
                @endif

                {{-- Chat history --}}
                @foreach($chatHistory as $entry)
                    @if($entry['role'] === 'user')
                        <div class="flex gap-3 justify-end">
                            <div class="bg-purple-700 text-white rounded-2xl rounded-tr-sm px-4 py-3 max-w-lg">
                                <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $entry['content'] }}</p>
                                <p class="text-xs text-purple-300 mt-1 text-right">{{ $entry['timestamp'] }}</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-zinc-700 flex items-center justify-center flex-shrink-0 mt-0.5" aria-hidden="true">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-700 flex items-center justify-center flex-shrink-0 mt-0.5" aria-hidden="true">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
                            </div>
                            <div class="bg-gray-100 dark:bg-zinc-800 rounded-2xl rounded-tl-sm px-4 py-3 max-w-2xl flex-1">
                                <div class="prose prose-sm dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                                    {!! \Illuminate\Support\Str::markdown(e($entry['content'])) !!}
                                </div>
                                <p class="text-xs text-gray-400 mt-2">{{ $entry['timestamp'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Loading indicator --}}
                @if($isLoading)
                    <div class="flex gap-3" aria-label="Assistant is typing">
                        <div class="w-8 h-8 rounded-full bg-purple-700 flex items-center justify-center flex-shrink-0 mt-0.5" aria-hidden="true">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
                        </div>
                        <div class="bg-gray-100 dark:bg-zinc-800 rounded-2xl rounded-tl-sm px-4 py-3">
                            <div class="flex items-center gap-1.5" aria-hidden="true">
                                <span class="w-2 h-2 rounded-full bg-purple-600 animate-bounce" style="animation-delay: 0ms"></span>
                                <span class="w-2 h-2 rounded-full bg-purple-600 animate-bounce" style="animation-delay: 150ms"></span>
                                <span class="w-2 h-2 rounded-full bg-purple-600 animate-bounce" style="animation-delay: 300ms"></span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Error --}}
                @if($errorMessage)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0 mt-0.5" aria-hidden="true">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                        </div>
                        <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-2xl rounded-tl-sm px-4 py-3">
                            <p class="text-sm text-red-700 dark:text-red-400">{{ $errorMessage }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Input area --}}
            <div class="border-t border-gray-200 dark:border-zinc-800 p-4 bg-gray-50 dark:bg-zinc-800/50">
                <form wire:submit.prevent="sendMessage" class="flex gap-3" aria-label="Send a message">
                    <label for="chat-input" class="sr-only">Your question</label>
                    <textarea
                        id="chat-input"
                        wire:model.defer="message"
                        placeholder="Ask a web development, hosting or DevOps question…"
                        rows="1"
                        class="flex-1 resize-none rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors placeholder:text-gray-400 dark:placeholder:text-gray-500"
                        @keydown.enter.prevent="if (!$event.shiftKey) { $wire.sendMessage(); }"
                        @input="$el.style.height = ''; $el.style.height = Math.min($el.scrollHeight, 120) + 'px'"
                        :disabled="$wire.isLoading"
                        aria-describedby="chat-hint"
                    ></textarea>
                    <button
                        type="submit"
                        :disabled="$wire.isLoading || !$wire.message.trim()"
                        class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-700 hover:bg-purple-800 disabled:bg-purple-400 text-white rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2"
                        aria-label="Send message"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
                <p id="chat-hint" class="text-xs text-gray-400 dark:text-gray-500 mt-2 text-center">
                    Press Enter to send · Shift+Enter for new line · This assistant only answers IT and web development questions
                </p>
                @error('message')
                    <p class="text-xs text-red-600 dark:text-red-400 mt-1 text-center" role="alert">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Disclaimer --}}
        <p class="text-xs text-gray-400 dark:text-gray-500 text-center mt-4">
            This assistant is powered by AI and may occasionally make mistakes. Always verify critical technical decisions independently.
            For professional consulting, <a href="{{ route('contact') }}" class="text-purple-600 dark:text-purple-400 hover:underline">contact Mark directly</a>.
        </p>
    </div>
</div>
