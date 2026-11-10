<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\RoomType;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [];
        $add = static function (string $path, ?string $modified = null) use (&$urls): void {
            $urls['https://hotel-lermont.ru' . $path] = $modified;
        };

        foreach (['home', 'rooms.index', 'offers.index', 'news.index', 'booking', 'reviews'] as $name) {
            $add(route($name, [], false));
        }

        // These paths are owned by dedicated routes or are private endpoints.
        $reserved = ['home', 'rooms', 'offers', 'news', 'booking', 'otzyvy', 'lk',
            'admin', 'account', 'login', 'logout', 'register', 'forgot-password',
            'reset-password', 'confirm-password', 'two-factor-challenge', 'up', 'contact-request'];

        foreach (Page::query()->where('is_active', true)->get(['slug', 'template', 'updated_at']) as $page) {
            if ($page->template === 'home' || in_array($page->slug, $reserved, true)
                || !preg_match('/\A[a-zA-Z0-9-]+\z/', $page->slug)) {
                continue;
            }
            $add(route('pages.show', ['slug' => $page->slug], false), $page->updated_at?->toAtomString());
        }
        foreach (RoomType::query()->where('is_active', true)->get(['slug', 'updated_at']) as $room) {
            $add(route('rooms.show', ['roomType' => $room->slug], false), $room->updated_at?->toAtomString());
        }
        foreach (Promotion::query()->active()->get(['slug', 'updated_at']) as $promotion) {
            if (preg_match('/\A[a-zA-Z0-9-]+\z/', $promotion->slug)) {
                $add(route('offers.show', ['slug' => $promotion->slug], false), $promotion->updated_at?->toAtomString());
            }
        }
        foreach (ContentItem::query()->published()->inCategory('news')->get(['slug', 'updated_at']) as $news) {
            $add(route('news.show', ['news' => $news->slug], false), $news->updated_at?->toAtomString());
        }

        $escape = static fn (string $value): string => htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url => $modified) {
            $xml .= '  <url><loc>' . $escape($url) . '</loc>';
            if ($modified !== null) {
                $xml .= '<lastmod>' . $escape($modified) . '</lastmod>';
            }
            $xml .= "</url>\n";
        }
        $xml .= "</urlset>\n";

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'no-store',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
