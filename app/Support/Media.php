<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Alignment;
use Intervention\Image\Laravel\Facades\Image;

class Media
{
    private static ?string $watermarkBinary = null;
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

    /**
     * Store an image where the web server can read it.
     */
    public static function storePublic(string $directory, UploadedFile $file, string $prefix): string
    {
        if (! $file->isValid()) {
            $limit = ini_get('upload_max_filesize') ?: 'the server limit';
            if (in_array($file->getError(), [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
                throw new \RuntimeException('That logo is larger than the server allows ('.$limit.').');
            }

            throw new \RuntimeException('The logo could not be uploaded.');
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }
        if (! in_array($ext, ['jpg', 'png'], true)) {
            throw new \RuntimeException('Use a PNG or JPEG logo.');
        }

        try {
            $mime = $file->getMimeType();
        } catch (\Throwable $e) {
            $mime = null;
        }
        if ($mime && ! in_array($mime, ['image/jpeg', 'image/png', 'image/jpg', 'application/octet-stream'], true)) {
            throw new \RuntimeException('Use a PNG or JPEG logo.');
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            throw new \RuntimeException('The logo must be 5 MB or smaller.');
        }

        $directory = trim($directory, '/');
        $dir = storage_path('app/public/'.$directory);
        if (! is_dir($dir) && ! @mkdir($dir, 0755, true) && ! is_dir($dir)) {
            throw new \RuntimeException('The server could not create the logo folder.');
        }

        self::openDirectory($dir);

        $name = $prefix.'-'.date('YmdHis').'-'.bin2hex(random_bytes(3)).'.'.$ext;
        try {
            $file->move($dir, $name);
        } catch (\Throwable $e) {
            throw new \RuntimeException('The server could not save the logo. Check that storage is writable.');
        }

        $stored = $dir.'/'.$name;
        @chmod($stored, 0644);
        self::openDirectory($dir);
        self::linkStorage();

        if ((fileperms($dir) & 0001) === 0) {
            @unlink($stored);
            throw new \RuntimeException('The logo folder is private, so the site cannot show a new logo.');
        }

        return $name;
    }

    /**
     * Resize a vehicle photo and stamp the company mark in the center.
     */
    public static function saveStampedPhoto(mixed $source, string $directory, string $filename): void
    {
        $directory = trim($directory, '/');
        $dir = storage_path('app/public/'.$directory);
        if (! is_dir($dir) && ! @mkdir($dir, 0755, true) && ! is_dir($dir)) {
            throw new \RuntimeException('The server could not create the photo folder.');
        }

        self::openDirectory($dir);

        $photo = Image::decode($source);
        $mark = Image::decode(self::watermarkBinary());
        if ($photo->width() < $mark->width()) {
            $mark = $mark->scale(width: max(1, $photo->width()));
        } else {
            $photo = $photo->resize(500, 375);
            $mark = $mark->scale(width: (int) round($photo->width() * 0.42));
        }
        if ($mark->height() > $photo->height()) {
            $mark = $mark->scale(height: max(1, $photo->height()));
        }
        $photo->insert($mark, alignment: Alignment::CENTER)->save($dir.'/'.$filename);
        @chmod($dir.'/'.$filename, 0644);
        self::linkStorage();
    }

    /**
     * Crop maca_wt.png to the logo and raise its opacity so it shows on a photo.
     */
    private static function watermarkBinary(): string
    {
        if (self::$watermarkBinary !== null) {
            return self::$watermarkBinary;
        }

        $path = storage_path('app/public/classified/maca_wt.png');
        $src = is_file($path) ? @imagecreatefrompng($path) : false;
        if ($src === false) {
            throw new \RuntimeException('The photo watermark is missing.');
        }

        imagealphablending($src, false);
        imagesavealpha($src, true);
        $width = imagesx($src);
        $height = imagesy($src);
        $minX = $width;
        $minY = $height;
        $maxX = 0;
        $maxY = 0;

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $color = imagecolorat($src, $x, $y);
                $opacity = (127 - (($color >> 24) & 0x7F)) / 127;
                if ($opacity < 0.06) {
                    continue;
                }
                $minX = min($minX, $x);
                $minY = min($minY, $y);
                $maxX = max($maxX, $x);
                $maxY = max($maxY, $y);
                $boosted = min(1, $opacity * 3.4);
                $alpha = (int) round(127 * (1 - $boosted));
                $pixel = imagecolorallocatealpha(
                    $src,
                    ($color >> 16) & 255,
                    ($color >> 8) & 255,
                    $color & 255,
                    $alpha
                );
                imagesetpixel($src, $x, $y, $pixel);
            }
        }

        if ($maxX <= $minX || $maxY <= $minY) {
            imagedestroy($src);
            throw new \RuntimeException('The photo watermark is missing.');
        }

        $pad = 8;
        $cropX = max(0, $minX - $pad);
        $cropY = max(0, $minY - $pad);
        $crop = imagecrop($src, [
            'x' => $cropX,
            'y' => $cropY,
            'width' => min($width, $maxX + $pad + 1) - $cropX,
            'height' => min($height, $maxY + $pad + 1) - $cropY,
        ]);
        imagedestroy($src);
        if ($crop === false) {
            throw new \RuntimeException('The photo watermark is missing.');
        }

        imagealphablending($crop, false);
        imagesavealpha($crop, true);
        ob_start();
        imagepng($crop);
        $binary = ob_get_clean();
        imagedestroy($crop);
        if ($binary === false || $binary === '') {
            throw new \RuntimeException('The photo watermark is missing.');
        }

        self::$watermarkBinary = $binary;

        return $binary;
    }

    /**
     * Let the web server enter this folder and its public parents.
     */
    private static function openDirectory(string $dir): void
    {
        $stop = storage_path('app/public');
        $current = $dir;
        while (str_starts_with($current, $stop) && is_dir($current)) {
            @chmod($current, 0755);
            if ($current === $stop) {
                break;
            }
            $parent = dirname($current);
            if ($parent === $current) {
                break;
            }
            $current = $parent;
        }
    }

    /**
     * Publish storage/app/public at /storage when the link is missing.
     */
    private static function linkStorage(): void
    {
        $link = public_path('storage');
        $target = storage_path('app/public');
        if (is_link($link)) {
            return;
        }
        if (! file_exists($link)) {
            @symlink($target, $link);
        }
    }
}
