<?php

use App\Livewire\Public\About;
use App\Livewire\Public\AiHelp;
use App\Livewire\Public\ContactForm;
use App\Livewire\Public\Home;
use App\Livewire\Public\ProjectDetail;
use App\Livewire\Public\ProjectsList;
use Illuminate\Support\Facades\Route;

// Public portfolio routes
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/projects', ProjectsList::class)->name('projects.index');
Route::get('/projects/{slug}', ProjectDetail::class)->name('projects.show');
Route::get('/ai-help', AiHelp::class)->name('ai-help');
Route::get('/contact', ContactForm::class)->name('contact');

use Illuminate\Support\Facades\Artisan;

Route::get('/run-symlink', function () {
    Artisan::call('storage:link');
    return 'Symlink created successfully!';
});


// Sitemap
Route::get('/sitemap.xml', function () {
    $projects = \App\Models\Project::published()->orderBy('sort_order')->get();

    return response()->view('sitemap', compact('projects'))
        ->header('Content-Type', 'text/xml');
})->name('sitemap');

// Authenticated area — redirect to admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('dashboard', '/admin/dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
