<?php

namespace App\Livewire\Public;

use App\Ai\Agents\Ai\TechHelpAgent;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AiHelp extends Component
{
    #[Rule(['required', 'string', 'min:3', 'max:1000'])]
    public string $message = '';

    public array $chatHistory = [];

    public bool $isLoading = false;

    public ?string $conversationId = null;

    public string $errorMessage = '';

    public function sendMessage(): void
    {
        $this->validate();

        $userMessage = trim($this->message);
        $this->message = '';
        $this->errorMessage = '';
        $this->isLoading = true;

        $this->chatHistory[] = [
            'role' => 'user',
            'content' => $userMessage,
            'timestamp' => now()->format('H:i'),
        ];

        try {
            $agent = new TechHelpAgent;

            if ($this->conversationId) {
                $response = $agent->continue($this->conversationId)->prompt($userMessage);
            } else {
                $response = $agent->prompt($userMessage);
                $this->conversationId = $response->conversationId ?? null;
            }

            $this->chatHistory[] = [
                'role' => 'assistant',
                'content' => $response->text,
                'timestamp' => now()->format('H:i'),
            ];
        } catch (\Throwable $e) {
            $this->errorMessage = 'Sorry, I was unable to process your request. Please try again shortly.';
            report($e);
        } finally {
            $this->isLoading = false;
        }

        $this->dispatch('scroll-to-bottom');
    }

    public function clearConversation(): void
    {
        $this->chatHistory = [];
        $this->conversationId = null;
        $this->message = '';
        $this->errorMessage = '';
    }

    public function render()
    {
        return view('livewire.public.ai-help')
            ->layout('layouts.public', [
                'title' => 'AI Help',
                'description' => 'Ask questions about web development, web hosting, DevOps, software architecture and IT. Powered by AI.',
            ]);
    }
}
