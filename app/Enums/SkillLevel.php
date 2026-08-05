<?php

namespace App\Enums;

enum SkillLevel: string
{
    case Advanced = 'advanced';
    case HighlyExperienced = 'highly_experienced';
    case Experienced = 'experienced';
    case WorkingKnowledge = 'working_knowledge';
    case CurrentlyDeveloping = 'currently_developing';

    public function label(): string
    {
        return match ($this) {
            self::Advanced => 'Advanced',
            self::HighlyExperienced => 'Highly Experienced',
            self::Experienced => 'Experienced',
            self::WorkingKnowledge => 'Working Knowledge',
            self::CurrentlyDeveloping => 'Currently Developing',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Advanced => 'bg-purple-700 text-white',
            self::HighlyExperienced => 'bg-purple-500 text-white',
            self::Experienced => 'bg-purple-300 text-purple-900',
            self::WorkingKnowledge => 'bg-purple-100 text-purple-800',
            self::CurrentlyDeveloping => 'bg-gray-100 text-gray-700',
        };
    }
}
