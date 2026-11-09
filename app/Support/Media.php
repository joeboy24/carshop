<?php

namespace App\Support;

class Media
{
    /**
     * Public storage path when the file is on this machine, otherwise the live copy.
     */
    public static function url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        $path = ltrim($path, '/');
        if (is_file(storage_path('app/public/'.$path))) {
            return '/storage/'.$path;
        }

        return 'https://macademiagroup.com/storage/'.$path;
    }
}
