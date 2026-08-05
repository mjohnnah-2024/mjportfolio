<?php

namespace App\Livewire\Admin\Messages;

use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\WithPagination;

class MessageList extends Component
{
    use WithPagination;

    public string $filter = 'all';

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function markRead(int $id): void
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();
        $this->dispatch('message-updated');
    }

    public function render()
    {
        $query = ContactMessage::latest();

        if ($this->filter === 'unread') {
            $query->unread();
        } elseif ($this->filter === 'read') {
            $query->whereNotNull('read_at');
        }

        return view('livewire.admin.messages.message-list', [
            'messages' => $query->paginate(20),
        ])->layout('layouts.admin', ['title' => 'Messages']);
    }
}
