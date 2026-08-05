<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProjectForm extends Component
{
    public ?int $projectId = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:255')]
    public string $slug = '';

    #[Validate('nullable|string|max:500')]
    public string $shortDescription = '';

    #[Validate('nullable|string')]
    public string $fullDescription = '';

    #[Validate('nullable|string')]
    public string $challenge = '';

    #[Validate('nullable|string')]
    public string $solution = '';

    #[Validate('nullable|string|max:255')]
    public string $client = '';

    #[Validate('nullable|url|max:500')]
    public string $githubUrl = '';

    #[Validate('nullable|url|max:500')]
    public string $liveUrl = '';

    #[Validate('required|in:draft,published,archived')]
    public string $status = 'draft';

    #[Validate('nullable|integer|exists:project_categories,id')]
    public ?int $projectCategoryId = null;

    public bool $isFeatured = false;
    public bool $isDemo = false;

    #[Validate('nullable|date')]
    public string $startDate = '';

    #[Validate('nullable|date')]
    public string $completionDate = '';

    #[Validate('nullable|string|max:255')]
    public string $seoTitle = '';

    #[Validate('nullable|string|max:500')]
    public string $seoDescription = '';

    public bool $isEditing = false;

    public function mount(?Project $project = null): void
    {
        if ($project && $project->exists) {
            $this->isEditing = true;
            $this->projectId = $project->id;
            $this->name = $project->name;
            $this->slug = $project->slug;
            $this->shortDescription = $project->short_description ?? '';
            $this->fullDescription = $project->full_description ?? '';
            $this->challenge = $project->challenge ?? '';
            $this->solution = $project->solution ?? '';
            $this->client = $project->client ?? '';
            $this->githubUrl = $project->github_url ?? '';
            $this->liveUrl = $project->live_url ?? '';
            $this->status = $project->status;
            $this->projectCategoryId = $project->project_category_id;
            $this->isFeatured = $project->is_featured;
            $this->isDemo = $project->is_demo;
            $this->startDate = $project->start_date?->format('Y-m-d') ?? '';
            $this->completionDate = $project->completion_date?->format('Y-m-d') ?? '';
            $this->seoTitle = $project->seo_title ?? '';
            $this->seoDescription = $project->seo_description ?? '';
        }
    }

    public function updatedName(string $value): void
    {
        if (! $this->isEditing) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->shortDescription ?: null,
            'full_description' => $this->fullDescription ?: null,
            'challenge' => $this->challenge ?: null,
            'solution' => $this->solution ?: null,
            'client' => $this->client ?: null,
            'github_url' => $this->githubUrl ?: null,
            'live_url' => $this->liveUrl ?: null,
            'status' => $this->status,
            'project_category_id' => $this->projectCategoryId,
            'is_featured' => $this->isFeatured,
            'is_demo' => $this->isDemo,
            'start_date' => $this->startDate ?: null,
            'completion_date' => $this->completionDate ?: null,
            'seo_title' => $this->seoTitle ?: null,
            'seo_description' => $this->seoDescription ?: null,
            'published_at' => $this->status === 'published' ? now() : null,
        ];

        if ($this->isEditing) {
            $project = Project::findOrFail($this->projectId);
            $project->update($data);
            session()->flash('success', 'Project updated successfully.');
        } else {
            Project::create($data);
            session()->flash('success', 'Project created successfully.');
        }

        $this->redirect(route('admin.projects.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.projects.project-form', [
            'categories' => ProjectCategory::orderBy('name')->get(),
        ])->layout('layouts.admin', ['title' => $this->isEditing ? 'Edit Project' : 'New Project']);
    }
}
