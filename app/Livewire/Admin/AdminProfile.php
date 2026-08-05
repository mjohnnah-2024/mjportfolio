<?php

namespace App\Livewire\Admin;

use App\Models\SocialLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminProfile extends Component
{
    // Account
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    // Profile
    #[Validate('nullable|string|max:50')]
    public string $phone = '';

    #[Validate('nullable|string|max:255')]
    public string $location = '';

    #[Validate('nullable|string|max:500')]
    public string $headline = '';

    // Social links
    #[Validate('nullable|url|max:500')]
    public string $github = '';

    #[Validate('nullable|url|max:500')]
    public string $linkedin = '';

    // Password change
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $newPasswordConfirmation = '';

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        $profile = $user->profile;
        if ($profile) {
            $this->phone = $profile->phone ?? '';
            $this->location = $profile->location ?? '';
            $this->headline = $profile->headline ?? '';
        }

        $this->github = SocialLink::where('platform', 'github')->value('url') ?? '';
        $this->linkedin = SocialLink::where('platform', 'linkedin')->value('url') ?? '';
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:500'],
            'github' => ['nullable', 'url', 'max:500'],
            'linkedin' => ['nullable', 'url', 'max:500'],
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $this->phone ?: null,
                'location' => $this->location ?: null,
                'headline' => $this->headline ?: null,
            ]
        );

        $this->upsertSocialLink('github', $this->github, 'code-bracket');
        $this->upsertSocialLink('linkedin', $this->linkedin, 'user');

        session()->flash('profileSuccess', 'Profile updated successfully.');
    }

    private function upsertSocialLink(string $platform, string $url, string $icon): void
    {
        if ($url) {
            SocialLink::updateOrCreate(
                ['platform' => $platform],
                ['url' => $url, 'icon' => $icon, 'is_active' => true]
            );
        } else {
            SocialLink::where('platform', $platform)->update(['url' => null, 'is_active' => false]);
        }
    }

    public function updatePassword(): void
    {
        $this->validate([
            'currentPassword' => ['required', 'string'],
            'newPassword' => ['required', Password::defaults(), 'confirmed'],
        ]);

        if (! Hash::check($this->currentPassword, Auth::user()->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');

            return;
        }

        Auth::user()->update(['password' => $this->newPassword]);

        $this->reset('currentPassword', 'newPassword', 'newPasswordConfirmation');
        session()->flash('passwordSuccess', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-profile')
            ->layout('layouts.admin', ['title' => 'My Profile']);
    }
}
