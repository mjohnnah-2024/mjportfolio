<?php

namespace App\Services;

class SeoService
{
    public function personSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Mark Johnnah',
            'email' => config('portfolio.email'),
            'telephone' => config('portfolio.phone'),
            'url' => url('/'),
            'sameAs' => [
                config('portfolio.github'),
                config('portfolio.linkedin'),
            ],
            'jobTitle' => 'Full-Stack Laravel Developer, Software Architect and AI-Assisted Development Engineer',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Port Moresby',
                'addressCountry' => 'PG',
            ],
        ];
    }

    public function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Mark Johnnah Portfolio',
            'url' => url('/'),
        ];
    }

    public function projectSchema(array $project): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $project['name'],
            'description' => $project['short_description'],
            'url' => url('/projects/' . $project['slug']),
            'author' => [
                '@type' => 'Person',
                'name' => 'Mark Johnnah',
            ],
        ];
    }

    public function breadcrumbSchema(array $items): array
    {
        $listItems = array_map(function ($item, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }, $items, array_keys($items));

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }
}

