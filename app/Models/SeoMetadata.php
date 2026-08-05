<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    protected $fillable = ['title', 'description', 'og_image_path', 'canonical_url'];

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }

    public function ogImageUrl(): ?string
    {
        return $this->og_image_path
            ? asset('storage/' . $this->og_image_path)
            : null;
    }
}
