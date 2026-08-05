<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Archived => 'Archived',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Draft => 'bg-yellow-100 text-yellow-800',
            self::Published => 'bg-green-100 text-green-800',
            self::Archived => 'bg-gray-100 text-gray-700',
        };
    }
}
