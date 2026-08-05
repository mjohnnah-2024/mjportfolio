<?php

namespace App\Models;

use App\Enums\ProjectMediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    protected $fillable = ['project_id', 'path', 'type', 'caption', 'alt_text', 'sort_order'];

    protected function casts(): array
    {
        return [
            'type' => ProjectMediaType::class,
            'sort_order' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}
