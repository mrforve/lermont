<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        $description = $currentPage?->seo_description
            ?: $siteSettings?->seo_description;
    @endphp

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

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>