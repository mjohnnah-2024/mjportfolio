<?php

use App\Livewire\Admin\AdminProfile;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Experience\ExperienceList;
use App\Livewire\Admin\Messages\MessageDetail;
use App\Livewire\Admin\Messages\MessageList;
use App\Livewire\Admin\Projects\ProjectForm;
use App\Livewire\Admin\Projects\ProjectList;
use App\Livewire\Admin\Settings\GeneralSettings;
use App\Livewire\Admin\Skills\SkillManager;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', AdminProfile::class)->name('profile');

    Route::get('/projects', ProjectList::class)->name('projects.index');
    Route::get('/projects/create', ProjectForm::class)->name('projects.create');
    Route::get('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');

    Route::get('/skills', SkillManager::class)->name('skills.index');

    Route::get('/experience', ExperienceList::class)->name('experience.index');

    Route::get('/messages', MessageList::class)->name('messages.index');
    Route::get('/messages/{message}', MessageDetail::class)->name('messages.show');

    Route::get('/settings', GeneralSettings::class)->name('settings.general');
});
