<?php

namespace App\Livewire\Public;

use App\Enums\EnquiryType;
use App\Jobs\SendContactNotification;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    #[Rule(['required', 'string', 'min:2', 'max:100'])]
    public string $name = '';

    #[Rule(['required', 'email', 'max:255'])]
    public string $email = '';

    #[Rule(['nullable', 'string', 'max:30'])]
    public string $phone = '';

    #[Rule(['nullable', 'string', 'max:100'])]
    public string $organisation = '';

    #[Rule(['required', 'string', 'min:5', 'max:200'])]
    public string $subject = '';

    #[Rule(['required', 'string'])]
    public string $enquiryType = '';

    #[Rule(['required', 'string', 'min:20', 'max:3000'])]
    public string $message = '';

    #[Rule(['accepted'])]
    public bool $consent = false;

    // Honeypot field — must remain empty
    public string $website = '';

    public bool $submitted = false;

    public string $errorMessage = '';

    public function submit(): void
    {
        // Honeypot check
        if (filled($this->website)) {
            $this->submitted = true;

            return;
        }

        $this->validate();

        $ip = request()->ip();
        $rateLimitKey = 'contact-form:' . sha1($ip);

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $this->errorMessage = 'Too many submissions. Please wait before trying again.';

            return;
        }

        RateLimiter::hit($rateLimitKey, 3600);

        $contactMessage = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'organisation' => $this->organisation ?: null,
            'subject' => $this->subject,
            'enquiry_type' => EnquiryType::from($this->enquiryType),
            'message' => $this->message,
            'ip_hash' => hash('sha256', $ip . config('app.key')),
            'user_agent_hash' => hash('sha256', (string) request()->userAgent() . config('app.key')),
        ]);

        SendContactNotification::dispatch($contactMessage);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.public.contact-form', [
            'enquiryTypes' => EnquiryType::cases(),
        ])->layout('layouts.public', [
            'title' => 'Contact',
            'description' => 'Get in touch with Mark Johnnah for Laravel development, AI applications, software architecture, DevOps and web hosting consulting.',
        ]);
    }
}
