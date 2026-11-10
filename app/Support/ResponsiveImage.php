<?php
namespace App\Support;

final class ResponsiveImage
{
    public static function url(?string $url, int $width = 1000): string
    {
        if (!$url) return '';
        $host = parse_url($url, PHP_URL_HOST);
        if ($host && !in_array($host, ['hotel-lermont.ru', 'www.hotel-lermont.ru'], true)) return $url;
        $path = ltrim(rawurldecode(parse_url($url, PHP_URL_PATH) ?: ''), '/');
        if (str_contains($path, '..') || str_starts_with($path, 'optimized-images/') || !preg_match('/\.(?:jpe?g|png|webp)\z/i', $path)) return $url;
        $source = realpath(public_path($path));
        $allowed = [realpath(public_path()), realpath(storage_path('app/public'))];
        if (!$source || !array_filter($allowed, fn ($base) => $base && str_starts_with($source, $base . DIRECTORY_SEPARATOR))) return $url;
        $width = max(120, min(1920, $width));
        $relative = 'optimized-images/' . $width . '/' . preg_replace('/\.[^.\/]+\z/', '.webp', $path);
        $target = public_path($relative);
        try {
            if (!is_file($target) || filemtime($target) < filemtime($source)) {
                $image = @imagecreatefromstring(file_get_contents($source));
                if (!$image) return $url;
                $w = min($width, imagesx($image)); $h = max(1, (int) round(imagesy($image) * $w / imagesx($image)));
                $out = imagecreatetruecolor($w, $h);
                imagealphablending($out, false); imagesavealpha($out, true);
                imagefill($out, 0, 0, imagecolorallocatealpha($out, 0, 0, 0, 127));
                imagecopyresampled($out, $image, 0, 0, 0, 0, $w, $h, imagesx($image), imagesy($image));
                if (!is_dir(dirname($target)) && !@mkdir(dirname($target), 0755, true) && !is_dir(dirname($target))) return $url;
                $temp = tempnam(dirname($target), '.webp-');
                try {
                    if (!imagewebp($out, $temp, 76)) return $url;
                    chmod($temp, 0644); rename($temp, $target);
                } finally { if (is_file($temp)) unlink($temp); imagedestroy($out); imagedestroy($image); }
            }
            return asset($relative) . '?v=' . filemtime($source);
        } catch (\Throwable) { return $url; }
    }
}
