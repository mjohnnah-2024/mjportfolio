<?php

namespace App\Jobs;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactNotification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public readonly ContactMessage $contactMessage) {}

    public function handle(): void
    {
        Mail::to(config('portfolio.contact_email'))
            ->send(new ContactMessageReceived($this->contactMessage));
    }
}

