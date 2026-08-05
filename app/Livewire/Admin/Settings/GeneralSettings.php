<?php

namespace App\Livewire\Admin\Settings;

use App\Services\SettingsService;
use Livewire\Component;

class GeneralSettings extends Component
{
    public string $siteTitle = '';
    public string $siteTagline = '';
    public string $metaDescription = '';

    public function mount(SettingsService $settings): void
    {
        $this->siteTitle = $settings->get('site_title', config('app.name'));
        $this->siteTagline = $settings->get('site_tagline', '');
        $this->metaDescription = $settings->get('meta_description', '');
    }

    public function save(SettingsService $settings): void
    {
        $this->validate([
            'siteTitle' => ['required', 'string', 'max:255'],
            'siteTagline' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:500'],
        ]);

        $settings->set('site_title', $this->siteTitle);
        $settings->set('site_tagline', $this->siteTagline);
        $settings->set('meta_description', $this->metaDescription);

        session()->flash('success', 'Settings saved.');
    }

    public function render()
    {
        return view('livewire.admin.settings.general-settings')
            ->layout('layouts.admin', ['title' => 'Settings']);
    }
}
