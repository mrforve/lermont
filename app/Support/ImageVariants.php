<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

final class ImageVariants
{
    private const PRESETS = [
        'hero' => [1920, 1080, 82],
        'about-hero' => [1600, 900, 82],
        'room-card' => [640, 640, 82],
        'news-card' => [800, 600, 82],
        'gallery-hero' => [1600, 900, 82],
        'gallery-card' => [800, 600, 82],
        'room-main' => [1200, 900, 84],
        'room-thumb' => [640, 480, 82],
        'content' => [1200, 900, 84],
    ];

    public static function url(?string $path, string $preset): string
    {
        if (blank($path)) {
            return '';
        }

        try {
            $variant = self::generate($path, $preset);

            return Storage::disk('public')->url($variant);
        } catch (Throwable $exception) {
            report($exception);

            return Storage::disk('public')->url($path);
        }
    }

    public static function generate(string $path, string $preset, bool $force = false): string
    {
        if (! isset(self::PRESETS[$preset])) {
            throw new RuntimeException("Unknown image preset [{$preset}].");
        }

        $disk = Storage::disk('public');
        $path = ltrim(str_replace('\\', '/', $path), '/');

        if (! $disk->exists($path)) {
            throw new RuntimeException("Source image [{$path}] does not exist.");
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (in_array($extension, ['svg', 'gif'], true)) {
            return $path;
        }

        [$targetWidth, $targetHeight, $quality] = self::PRESETS[$preset];
        $outputExtension = function_exists('imagewebp') ? 'webp' : 'jpg';
        $filename = pathinfo($path, PATHINFO_FILENAME) . '.' . $outputExtension;
        $directory = trim(pathinfo($path, PATHINFO_DIRNAME), '.');
        $variantPath = '_variants/' . $preset . '/' . ($directory ? $directory . '/' : '') . $filename;

        if (! $force && $disk->exists($variantPath)) {
            $sourceTime = $disk->lastModified($path);
            $variantTime = $disk->lastModified($variantPath);

            if ($variantTime >= $sourceTime) {
                return $variantPath;
            }
        }

        $sourceBytes = $disk->get($path);
        $source = @imagecreatefromstring($sourceBytes);

        if (! $source) {
            throw new RuntimeException("Cannot decode image [{$path}].");
        }

        $sourceWidth = imagesx($source);
        $sourceHeight = imagesy($source);

        if ($sourceWidth < 1 || $sourceHeight < 1) {
            imagedestroy($source);
            throw new RuntimeException("Invalid image dimensions for [{$path}].");
        }

        $sourceRatio = $sourceWidth / $sourceHeight;
        $targetRatio = $targetWidth / $targetHeight;

        if ($sourceRatio > $targetRatio) {
            $cropHeight = $sourceHeight;
            $cropWidth = (int) round($sourceHeight * $targetRatio);
            $sourceX = (int) floor(($sourceWidth - $cropWidth) / 2);
            $sourceY = 0;
        } else {
            $cropWidth = $sourceWidth;
            $cropHeight = (int) round($sourceWidth / $targetRatio);
            $sourceX = 0;
            $sourceY = (int) floor(($sourceHeight - $cropHeight) / 2);
        }

        $target = imagecreatetruecolor($targetWidth, $targetHeight);
        $background = imagecolorallocate($target, 255, 255, 255);
        imagefill($target, 0, 0, $background);

        imagecopyresampled(
            $target,
            $source,
            0,
            0,
            $sourceX,
            $sourceY,
            $targetWidth,
            $targetHeight,
            $cropWidth,
            $cropHeight,
        );

        ob_start();

        if ($outputExtension === 'webp') {
            imagewebp($target, null, $quality);
        } else {
            imagejpeg($target, null, $quality);
        }

        $encoded = ob_get_clean();
        imagedestroy($source);
        imagedestroy($target);

        if (! is_string($encoded) || $encoded === '') {
            throw new RuntimeException("Cannot encode variant for [{$path}].");
        }

        $disk->put($variantPath, $encoded, ['visibility' => 'public']);

        return $variantPath;
    }
}
