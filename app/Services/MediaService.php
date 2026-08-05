<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    private const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    private const MAX_SIZE_BYTES = 5 * 1024 * 1024; // 5 MB

    public function storeProjectImage(UploadedFile $file, string $folder = 'projects'): string
    {
        $this->validateImage($file);

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $filename, 'private');

        return $path;
    }

    public function storeAvatar(UploadedFile $file): string
    {
        $this->validateImage($file);

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('avatars', $filename, 'private');

        return $path;
    }

    public function delete(string $path): void
    {
        if (Storage::disk('private')->exists($path)) {
            Storage::disk('private')->delete($path);
        }
    }

    private function validateImage(UploadedFile $file): void
    {
        if ($file->getSize() > self::MAX_SIZE_BYTES) {
            throw new \InvalidArgumentException('File size exceeds the 5 MB limit.');
        }

        if (! in_array($file->getMimeType(), self::ALLOWED_MIME_TYPES, true)) {
            throw new \InvalidArgumentException('File type is not allowed. Accepted: JPEG, PNG, GIF, WebP.');
        }
    }
}

