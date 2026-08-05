<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_category_id',
        'name',
        'slug',
        'short_description',
        'full_description',
        'challenge',
        'solution',
        'key_features',
        'architecture_summary',
        'responsibilities',
        'status',
        'is_featured',
        'is_demo',
        'start_date',
        'completion_date',
        'client',
        'logo_path',
        'featured_image_path',
        'github_url',
        'live_url',
        'case_study',
        'sort_order',
        'seo_title',
        'seo_description',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_demo' => 'boolean',
            'start_date' => 'date',
            'completion_date' => 'date',
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeForCategory(Builder $query, int $categoryId): void
    {
        $query->where('project_category_id', $categoryId);
    }

    public function featuredImageUrl(): ?string
    {
        return $this->featured_image_path
            ? asset('storage/' . $this->featured_image_path)
            : null;
    }

    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->isPast();
    }
}
