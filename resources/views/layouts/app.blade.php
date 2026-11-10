<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="/fonts/local/017fab69b4be8ffc.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="/fonts/local/d80df8ff5aecd299.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="/fonts/local/447c49583b1b735c.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="/fonts/local/8c2def024c1bf31a.woff2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://ru-ibe.tlintegration.ru">
    <link rel="preconnect" href="https://bf2gc.travellinecdn.com" crossorigin>


    @php
        $currentPage = $page ?? null;
        $siteSettings = $settings ?? null;

        $pageTitle = trim($__env->yieldContent('title'));
        $title = $pageTitle !== ''
            ? $pageTitle
            : (
                $currentPage?->seo_title
                ?: $currentPage?->title
                ?: $siteSettings?->seo_title
                ?: $siteSettings?->site_name
                ?: 'Lermont'
            );

        $description = trim($__env->yieldContent('description'))
            ?: $currentPage?->seo_description
            ?: $siteSettings?->seo_description;
    @endphp

    @include('partials.structured-data')

    <link rel="canonical" href="{{ \App\Support\StructuredData::canonicalUrl() }}">

    @php
        $shareImagePath = ($roomType ?? null)?->main_image
            ?: ($news ?? null)?->image
            ?: ($promotion ?? null)?->image
            ?: ($slides ?? collect())->first()?->image
            ?: $siteSettings?->logo;
        $shareImageUrl = $shareImagePath ? asset('storage/' . $shareImagePath) : null;
    @endphp
    <meta property="og:type" content="{{ isset($news) ? 'article' : 'website' }}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="{{ $siteSettings?->site_name ?: 'Отель Лермонт' }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ \App\Support\StructuredData::canonicalUrl() }}">
    @if ($shareImageUrl)
        <meta property="og:image" content="{{ $shareImageUrl }}">
        <meta property="og:image:alt" content="{{ isset($roomType) ? $roomType->name : ($siteSettings?->site_name ?: 'Отель Лермонт') }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    @if ($shareImageUrl)
        <meta name="twitter:image" content="{{ $shareImageUrl }}">
    @endif

    <title>{{ $title }}</title>
    @if ($description)
        <meta name="description" content="{{ $description }}">
    @endif

    @if ($siteSettings?->favicon)
        <link
            rel="icon"
            href="{{ asset('storage/' . $siteSettings->favicon) }}"
        >
    @endif

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    @stack('styles')
    @include('partials.yandex-metrika')
</head>
<body>
    @include('partials.yandex-metrika-noscript')
    @include('partials.header')

    <main>
        @include('partials.travelline-search')
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.cookie-notice')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/cookie-notice.js') }}?v=20261025-1" defer></script>
    @stack('scripts')
</body>
</html>
