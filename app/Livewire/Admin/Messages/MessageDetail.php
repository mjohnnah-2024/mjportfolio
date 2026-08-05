<?php

namespace App\Livewire\Admin\Messages;

use App\Models\ContactMessage;
use Livewire\Component;

class MessageDetail extends Component
{
    public ContactMessage $message;

    public function mount(ContactMessage $message): void
    {
        $this->message = $message;

        if (! $message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }
    }

    public function delete(): void
    {
        $this->message->delete();
        session()->flash('success', 'Message deleted.');
        $this->redirect(route('admin.messages.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.messages.message-detail')
            ->layout('layouts.admin', ['title' => 'Message']);
    }
}
