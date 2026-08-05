<?php

use App\Livewire\Public\ContactForm;
use App\Models\ContactMessage;
use Livewire\Livewire;

test('contact form renders', function () {
    $this->get(route('contact'))->assertOk();
});

test('contact form validates required fields', function () {
    Livewire::test(ContactForm::class)
        ->call('submit')
        ->assertHasErrors(['name', 'email', 'enquiryType', 'subject', 'message', 'consent']);
});

test('contact form validates email format', function () {
    Livewire::test(ContactForm::class)
        ->set('email', 'not-an-email')
        ->call('submit')
        ->assertHasErrors(['email']);
});

test('contact form rejects honeypot submissions', function () {
    Livewire::test(ContactForm::class)
        ->set('website', 'http://spam.example.com')
        ->set('name', 'Spammer')
        ->set('email', 'spam@example.com')
        ->set('enquiryType', 'general_enquiry')
        ->set('subject', 'Test')
        ->set('message', 'This is a test message from a bot.')
        ->set('consent', true)
        ->call('submit');

    expect(ContactMessage::count())->toBe(0);
});

test('contact form creates message on valid submission', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('enquiryType', 'general_enquiry')
        ->set('subject', 'Hello')
        ->set('message', 'This is a test enquiry message.')
        ->set('consent', true)
        ->call('submit')
        ->assertHasNoErrors();

    expect(ContactMessage::where('email', 'jane@example.com')->exists())->toBeTrue();
});
