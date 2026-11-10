<?php
namespace App\Support;

use App\Models\Slide;
use App\Models\SiteSetting;

class StructuredData
{
    private const BASE = 'https://hotel-lermont.ru';

    public static function canonicalUrl(): string
    {
        $path = request()->getPathInfo();
        $url = self::BASE . ($path === '/' ? '/' : rtrim($path, '/'));
        $page = filter_var(request()->query('page'), FILTER_VALIDATE_INT);
        if (request()->routeIs('rooms.index', 'news.index') && $page !== false && $page > 1) {
            $url .= '?page=' . $page;
        }
        return $url;
    }

    private static function text(?string $value): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($value ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    }

    private static function image(?string $path): ?string
    {
        if (!$path) return null;
        return self::BASE . '/storage/' . ltrim($path, '/');
    }

    public static function build(?SiteSetting $settings, string $title, ?string $description, array $data): ?array
    {
        $route = request()->route()?->getName();
        if (!in_array($route, ['home', 'pages.show', 'rooms.index', 'rooms.show', 'offers.index', 'offers.show', 'news.index', 'news.show', 'booking', 'reviews'], true)) return null;
        $config = config('structured-data');
        $url = self::canonicalUrl();
        $hotelId = self::BASE . '/#hotel';
        $websiteId = self::BASE . '/#website';
        $pageId = $url . '#webpage';
        $hotel = [
            '@type' => 'Hotel', '@id' => $hotelId, 'name' => $settings?->site_name ?: $config['name'],
            'url' => self::BASE . '/', 'telephone' => $settings?->phone ?: $config['telephone'],
            'email' => $settings?->email ?: $config['email'], 'address' => $config['address'],
            'numberOfRooms' => $config['number_of_rooms'],
            'legalName' => $settings?->company_name ?: $config['legal_name'],
            'taxID' => $settings?->company_inn ?: $config['tax_id'],
            'identifier' => ['@type' => 'PropertyValue', 'propertyID' => 'ОГРНИП', 'value' => $settings?->company_ogrn ?: $config['registration_id']],
            'sameAs' => array_values(array_unique(array_filter(array_merge($config['same_as'], [$settings?->vk_url, $settings?->youtube_url])))),
        ];
        if ($settings?->logo) $hotel['logo'] = ['@type' => 'ImageObject', 'url' => self::image($settings->logo)];
        $slide = Slide::query()->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn ($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
            ->orderBy('sort_order')->first(['image']);
        if ($slide?->image) $hotel['image'] = self::image($slide->image);
        if ($config['stars'] !== null) $hotel['starRating'] = ['@type' => 'Rating', 'ratingValue' => $config['stars']];
        if ($config['checkin_time']) $hotel['checkinTime'] = $config['checkin_time'];
        if ($config['checkout_time']) $hotel['checkoutTime'] = $config['checkout_time'];
        if ($config['latitude'] !== null && $config['longitude'] !== null) $hotel['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => $config['latitude'], 'longitude' => $config['longitude']];

        $page = ['@type' => 'WebPage', '@id' => $pageId, 'url' => $url, 'name' => self::text($title),
            'inLanguage' => 'ru-RU', 'isPartOf' => ['@id' => $websiteId], 'about' => ['@id' => $hotelId]];
        if (self::text($description) !== '') $page['description'] = self::text($description);
        $graph = [$hotel, ['@type' => 'WebSite', '@id' => $websiteId, 'url' => self::BASE . '/',
            'name' => $hotel['name'], 'inLanguage' => 'ru-RU', 'publisher' => ['@id' => $hotelId]]];
        $crumbs = [['name' => 'Главная', 'url' => self::BASE . '/']];
        $label = $data['page']?->title ?? self::text($title);

        if ($route === 'pages.show') {
            $page['@type'] = match ($data['page']?->slug) {'about' => 'AboutPage', 'contacts' => 'ContactPage', 'gallery' => 'ImageGallery', default => 'WebPage'};
        }
        if ($route === 'rooms.show' && $room = $data['roomType']) {
            $page['@type'] = 'ItemPage'; $label = $room->name;
            $crumbs[] = ['name' => 'Номера', 'url' => self::BASE . '/rooms'];
            $roomNode = ['@type' => 'HotelRoom', '@id' => $url . '#room', 'url' => $url, 'name' => $room->name,
                'description' => self::text($room->short_description ?: $room->description), 'containedInPlace' => ['@id' => $hotelId]];
            if ($room->area) $roomNode['floorSize'] = ['@type' => 'QuantitativeValue', 'value' => $room->area, 'unitCode' => 'MTK'];
            if ($room->capacity) $roomNode['occupancy'] = ['@type' => 'QuantitativeValue', 'maxValue' => $room->capacity + ($room->extra_capacity ?: 0)];
            $images = array_values(array_unique(array_filter(array_merge([self::image($room->main_image)], $room->images->map(fn ($img) => self::image($img->image))->all()))));
            if ($images) $roomNode['image'] = $images;
            $graph[] = $roomNode; $page['mainEntity'] = ['@id' => $roomNode['@id']];
        }
        if ($route === 'news.show' && $news = $data['news']) {
            $label = $news->title; $crumbs[] = ['name' => 'Новости', 'url' => self::BASE . '/news'];
            $article = ['@type' => 'NewsArticle', '@id' => $url . '#article', 'url' => $url,
                'headline' => $news->title, 'description' => self::text($news->short_description ?: $description),
                'inLanguage' => 'ru-RU', 'mainEntityOfPage' => ['@id' => $pageId], 'publisher' => ['@id' => $hotelId]];
            if ($news->image) $article['image'] = self::image($news->image);
            if ($news->published_at) $article['datePublished'] = $news->published_at->toAtomString();
            if ($news->updated_at) $article['dateModified'] = $news->updated_at->toAtomString();
            $graph[] = $article; $page['mainEntity'] = ['@id' => $article['@id']];
        }
        if ($route === 'offers.show' && $promotion = $data['promotion']) {
            $label = $promotion->title; $crumbs[] = ['name' => 'Акции', 'url' => self::BASE . '/offers'];
            if ($promotion->image) $page['image'] = self::image($promotion->image);
        }
        $list = match ($route) {'rooms.index' => ['items' => $data['roomTypes'], 'route' => 'rooms.show', 'key' => 'roomType', 'label' => 'name'],
            'news.index' => ['items' => $data['newsItems'], 'route' => 'news.show', 'key' => 'news', 'label' => 'title'],
            'offers.index' => ['items' => $data['promotions'], 'route' => 'offers.show', 'key' => 'slug', 'label' => 'title'], default => null};
        if ($list) {
            $page['@type'] = 'CollectionPage'; $items = [];
            foreach ($list['items'] as $item) $items[] = ['@type' => 'ListItem', 'position' => count($items) + 1,
                'name' => $item->{$list['label']}, 'url' => self::BASE . route($list['route'], [$list['key'] => $item->slug], false)];
            $graph[] = ['@type' => 'ItemList', '@id' => $url . '#list', 'itemListElement' => $items, 'numberOfItems' => count($items)];
            $page['mainEntity'] = ['@id' => $url . '#list'];
        }
        if ($route === 'home') $page['mainEntity'] = ['@id' => $hotelId];
        else {
            $crumbs[] = ['name' => $label, 'url' => $url]; $items = [];
            foreach ($crumbs as $crumb) $items[] = ['@type' => 'ListItem', 'position' => count($items) + 1, 'name' => $crumb['name'], 'item' => $crumb['url']];
            $graph[] = ['@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => $items];
            $page['breadcrumb'] = ['@id' => $url . '#breadcrumb'];
        }
        $graph[] = $page;
        return ['@context' => 'https://schema.org', '@graph' => $graph];
    }
}
