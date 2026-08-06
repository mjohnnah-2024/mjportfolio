<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectForm extends Component
{
    use WithFileUploads;

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

    #[Validate('nullable|image|max:2048|mimes:jpg,jpeg,png,gif,webp')]
    public $featuredImage = null;

    #[Validate('nullable|image|max:1024|mimes:jpg,jpeg,png,gif,webp')]
    public $logo = null;

    public ?string $currentFeaturedImagePath = null;

    public ?string $currentLogoPath = null;

    public bool $removeFeaturedImageFlag = false;

    public bool $removeLogoFlag = false;

    public ?string $imageError = null;

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
            $this->currentFeaturedImagePath = $project->featured_image_path;
            $this->currentLogoPath = $project->logo_path;
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

    public function clearFeaturedImage(): void
    {
        $this->featuredImage = null;
        $this->removeFeaturedImageFlag = true;
    }

    public function clearLogo(): void
    {
        $this->logo = null;
        $this->removeLogoFlag = true;
    }

    public function save(): void
    {
        $this->validate();

        $this->imageError = null;

        // Handle featured image
        $featuredImagePath = $this->currentFeaturedImagePath;

        try {
            if ($this->featuredImage) {
                if ($featuredImagePath) {
                    Storage::disk('public')->delete($featuredImagePath);
                }
                $featuredImagePath = $this->featuredImage->store('projects/featured', 'public');
            } elseif ($this->removeFeaturedImageFlag) {
                if ($featuredImagePath) {
                    Storage::disk('public')->delete($featuredImagePath);
                }
                $featuredImagePath = null;
            }

            // Handle logo
            $logoPath = $this->currentLogoPath;
            if ($this->logo) {
                if ($logoPath) {
                    Storage::disk('public')->delete($logoPath);
                }
                $logoPath = $this->logo->store('projects/logos', 'public');
            } elseif ($this->removeLogoFlag) {
                if ($logoPath) {
                    Storage::disk('public')->delete($logoPath);
                }
                $logoPath = null;
            }
        } catch (\Throwable $e) {
            $this->imageError = 'Image upload failed. The server is missing the PHP fileinfo extension. Please contact your hosting provider to enable fileinfo in PHP.';
            $featuredImagePath = $this->currentFeaturedImagePath;
            $logoPath = $this->currentLogoPath;
        }

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
            'featured_image_path' => $featuredImagePath,
            'logo_path' => $logoPath,
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
