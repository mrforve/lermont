<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\RoomType;
use App\Models\Slide;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::query()
            ->where('template', 'home')
            ->where('is_active', true)
            ->first();

        $slides = Slide::query()
            ->where('is_active', true)
            ->where(function ($query): void {
                $query
                    ->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query
                    ->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->get();

        $roomTypes = RoomType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $newsItems = ContentItem::query()
            ->with('category')
            ->published()
            ->inCategory('news')
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('pages.home', [
            'page' => $page,
            'slides' => $slides,
            'roomTypes' => $roomTypes,
            'newsItems' => $newsItems,
        ]);
    }

    public function show(string $slug): View
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        if ($page->slug === 'about') {
            $slides = Slide::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $roomTypes = RoomType::query()
                ->with(['images' => fn ($query) => $query->where('is_active', true)])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();

            return view('pages.about', compact('page', 'slides', 'roomTypes'));
        }

        if ($page->slug === 'gallery') {
            $galleryImages = GalleryImage::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->get();

            return view('pages.gallery', compact('page', 'galleryImages'));
        }

        if ($page->slug === 'contacts') {
            return view('pages.contacts', compact('page'));
        }

        if ($page->slug === 'services') {
            $galleryImages = GalleryImage::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->limit(8)
                ->get();

            return view('pages.services', compact('page', 'galleryImages'));
        }

        return view('pages.show', compact('page'));
    }
}
