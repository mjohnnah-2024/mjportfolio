<?php

namespace App\Livewire\Public;

use App\Models\Project;
use App\Models\Service;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.public.home', [
            'featuredProjects' => Project::published()
                ->featured()
                ->with(['category', 'technologies'])
                ->orderBy('sort_order')
                ->limit(6)
                ->get(),
            'services' => Service::active()->orderBy('sort_order')->get(),
        ])->layout('layouts.public', [
            'title' => null,
            'description' => 'Mark Johnnah is a senior full-stack Laravel developer, software architect and AI-assisted development engineer with more than 15 years of experience.',
        ]);
    }
}
