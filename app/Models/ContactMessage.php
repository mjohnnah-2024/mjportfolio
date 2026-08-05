<?php

namespace App\Models;

use App\Enums\EnquiryType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'organisation',
        'subject',
        'enquiry_type',
        'message',
        'is_read',
        'read_at',
        'replied_at',
        'ip_hash',
        'user_agent_hash',
    ];

    protected function casts(): array
    {
        return [
            'enquiry_type' => EnquiryType::class,
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function scopeUnread(Builder $query): void
    {
        $query->where('is_read', false);
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->update(['is_read' => true, 'read_at' => now()]);
        }
    }

    public function markAsReplied(): void
    {
        $this->update(['replied_at' => now()]);
    }
}
