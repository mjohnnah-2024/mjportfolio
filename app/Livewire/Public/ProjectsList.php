<?php

namespace App\Livewire\Public;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsList extends Component
{
    use WithPagination;

    public string $selectedCategory = '';

    public string $selectedTechnology = '';

    public string $search = '';

    public function updatedSelectedCategory(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedTechnology(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->selectedCategory = '';
        $this->selectedTechnology = '';
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Project::published()
            ->with(['category', 'technologies'])
            ->orderBy('sort_order');

        if ($this->selectedCategory) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $this->selectedCategory));
        }

        if ($this->selectedTechnology) {
            $query->whereHas('technologies', fn ($q) => $q->where('slug', $this->selectedTechnology));
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.public.projects-list', [
            'projects' => $query->paginate(9),
            'categories' => ProjectCategory::orderBy('sort_order')->get(),
            'technologies' => Technology::orderBy('name')->get(),
        ])->layout('layouts.public', [
            'title' => 'Projects',
            'description' => 'Browse Mark Johnnah\'s portfolio of Laravel, AI, DevOps, and enterprise web application projects.',
        ]);
    }
}
