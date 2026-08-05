<?php

namespace App\Livewire\Public;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\Service;
use App\Models\SkillCategory;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.public.about', [
            'profile' => Profile::first(),
            'skillCategories' => SkillCategory::with('skills')->orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('sort_order')->get(),
            'services' => Service::active()->orderBy('sort_order')->get(),
        ])->layout('layouts.public', [
            'title' => 'About',
            'description' => 'Learn about Mark Johnnah — senior full-stack Laravel developer, software architect, AI-assisted development engineer, DevOps and web hosting specialist.',
        ]);
    }
}
