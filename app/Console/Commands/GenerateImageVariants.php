<?php

namespace App\Console\Commands;

use App\Models\ContentItem;
use App\Models\GalleryImage;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use App\Models\Slide;
use App\Support\ImageVariants;
use Illuminate\Console\Command;
use Throwable;

class GenerateImageVariants extends Command
{
    protected $signature = 'images:variants {--force : Recreate existing variants}';

    protected $description = 'Generate correctly sized image variants used on the frontend';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $jobs = [];

        Slide::query()->get()->each(function (Slide $slide) use (&$jobs): void {
            if ($slide->image) {
                $jobs[] = [$slide->image, 'hero'];
            }
            if ($slide->mobile_image) {
                $jobs[] = [$slide->mobile_image, 'about-hero'];
            }
        });

        RoomType::query()->whereNotNull('main_image')->pluck('main_image')->each(function (string $path) use (&$jobs): void {
            $jobs[] = [$path, 'room-card'];
            $jobs[] = [$path, 'room-main'];
        });

        RoomTypeImage::query()->whereNotNull('image')->pluck('image')->each(function (string $path) use (&$jobs): void {
            $jobs[] = [$path, 'room-thumb'];
        });

        GalleryImage::query()->whereNotNull('image')->pluck('image')->each(function (string $path) use (&$jobs): void {
            $jobs[] = [$path, 'gallery-card'];
            $jobs[] = [$path, 'gallery-hero'];
        });

        ContentItem::query()->whereNotNull('image')->pluck('image')->each(function (string $path) use (&$jobs): void {
            $jobs[] = [$path, 'news-card'];
            $jobs[] = [$path, 'content'];
        });

        $jobs = collect($jobs)->unique(fn (array $job): string => implode('|', $job))->values();
        $bar = $this->output->createProgressBar($jobs->count());
        $bar->start();
        $failed = 0;

        foreach ($jobs as [$path, $preset]) {
            try {
                ImageVariants::generate($path, $preset, $force);
            } catch (Throwable $exception) {
                $failed++;
                $this->newLine();
                $this->warn("{$path} [{$preset}]: {$exception->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Generated image variants: ' . ($jobs->count() - $failed));

        if ($failed > 0) {
            $this->warn("Failed: {$failed}");
        }

        return self::SUCCESS;
    }
}
