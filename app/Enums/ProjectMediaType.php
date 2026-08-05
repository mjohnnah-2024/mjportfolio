<?php

namespace App\Enums;

enum ProjectMediaType: string
{
    case Screenshot = 'screenshot';
    case Logo = 'logo';
    case Diagram = 'diagram';
    case Video = 'video';

    public function label(): string
    {
        return match ($this) {
            self::Screenshot => 'Screenshot',
            self::Logo => 'Logo',
            self::Diagram => 'Diagram',
            self::Video => 'Video',
        };
    }
}
