<?php

namespace App\Livewire\Admin;

use App\Models\ContactMessage;
use App\Models\Project;
use Livewire\Component;

class Dashboard extends Component
{
    public int $totalProjects;
    public int $publishedProjects;
    public int $unreadMessages;
    public int $totalMessages;

    public function mount(): void
    {
        $this->totalProjects = Project::count();
        $this->publishedProjects = Project::published()->count();
        $this->totalMessages = ContactMessage::count();
        $this->unreadMessages = ContactMessage::unread()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'recentMessages' => ContactMessage::unread()->latest()->take(5)->get(),
        ])->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}
