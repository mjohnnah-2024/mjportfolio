<?php

namespace App\Livewire\Public;

use App\Models\Project;
use Illuminate\Support\Facades\Abort;
use Livewire\Component;

class ProjectDetail extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $project = Project::published()
            ->with(['category', 'technologies', 'media'])
            ->where('slug', $this->slug)
            ->firstOrFail();

        $related = Project::published()
            ->with(['category', 'technologies'])
            ->where('id', '!=', $project->id)
            ->when($project->project_category_id, fn ($q) => $q->forCategory($project->project_category_id))
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('livewire.public.project-detail', ['project' => $project, 'relatedProjects' => $related])
            ->layout('layouts.public', [
                'title' => $project->seo_title ?: $project->name,
                'description' => $project->seo_description ?: $project->short_description,
            ]);
    }
}
