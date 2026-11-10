@php
    $structuredData = \App\Support\StructuredData::build($settings ?? null, $title, $description, [
        'page' => $page ?? null,
        'roomType' => $roomType ?? null,
        'news' => $news ?? null,
        'promotion' => $promotion ?? null,
        'roomTypes' => $roomTypes ?? [],
        'newsItems' => $newsItems ?? [],
        'promotions' => $promotions ?? [],
    ]);
@endphp
@if ($structuredData)
<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
@endif
