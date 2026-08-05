<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        Project::findOrFail($id)->delete();
        session()->flash('success', 'Project deleted.');
    }

    public function render()
    {
        $query = Project::withTrashed()->with('category');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return view('livewire.admin.projects.project-list', [
            'projects' => $query->latest()->paginate(15),
        ])->layout('layouts.admin', ['title' => 'Projects']);
    }
}
