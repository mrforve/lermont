@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@section('content')
@php
    $categoryLabels = [
        'all' => 'Все фотографии',
        'hotel' => 'Отель',
        'rooms' => 'Номера',
        'breakfast' => 'Завтраки',
        'location' => 'Локация',
        'details' => 'Детали',
    ];
    $availableCategories = $galleryImages->pluck('category')->unique()->values();
    $heroImage = $galleryImages->first()?->image;
@endphp

<section class="hotel-gallery-hero" @if($heroImage) style="--gallery-hero-image: url('{{ \App\Support\ImageVariants::url($heroImage, 'gallery-hero') }}')" @endif>
    <div class="container hotel-gallery-hero__content">
        <div class="hotel-gallery-eyebrow"><span></span> ЛЕРМОНТ</div>
        <h1>{{ $page->title ?: 'Галерея отеля' }}</h1>
        <p>{{ $page->content ? strip_tags($page->content) : 'Атмосфера отеля, уютные номера и детали вашего отдыха в самом центре Геленджика.' }}</p>
    </div>
</section>

<section class="hotel-gallery-section" data-hotel-gallery>
    <div class="container">
        @if($galleryImages->isNotEmpty())
            <div class="hotel-gallery-filter" aria-label="Фильтр галереи">
                <button type="button" class="is-active" data-gallery-filter="all">Все фотографии</button>
                @foreach($availableCategories as $category)
                    <button type="button" data-gallery-filter="{{ $category }}">{{ $categoryLabels[$category] ?? $category }}</button>
                @endforeach
            </div>

            <div class="hotel-gallery-grid">
                @foreach($galleryImages as $image)
                    <button
                        type="button"
                        class="hotel-gallery-item"
                        data-gallery-item
                        data-gallery-category="{{ $image->category }}"
                        data-gallery-src="{{ asset('storage/' . $image->image) }}"
                        data-gallery-alt="{{ $image->alt ?: $image->title ?: 'Фотография отеля Лермонт' }}"
                        data-gallery-title="{{ $image->title }}"
                    >
                        <img src="{{ \App\Support\ImageVariants::url($image->image, 'gallery-card') }}" alt="{{ $image->alt ?: $image->title ?: 'Фотография отеля Лермонт' }}" loading="lazy">
                        @if($image->title)
                            <span class="hotel-gallery-item__caption">{{ $image->title }}</span>
                        @endif
                        <span class="hotel-gallery-item__zoom" aria-hidden="true">+</span>
                    </button>
                @endforeach
            </div>
        @else
            <div class="hotel-gallery-empty">
                <h2>Галерея скоро появится</h2>
                <p>Фотографии можно добавить в административной панели в разделе «Галерея».</p>
            </div>
        @endif
    </div>
</section>

<div class="hotel-gallery-lightbox" data-gallery-lightbox aria-hidden="true" role="dialog" aria-modal="true" aria-label="Просмотр фотографии">
    <button type="button" class="hotel-gallery-lightbox__backdrop" data-gallery-close aria-label="Закрыть"></button>
    <div class="hotel-gallery-lightbox__dialog">
        <button type="button" class="hotel-gallery-lightbox__close" data-gallery-close aria-label="Закрыть">×</button>
        <button type="button" class="hotel-gallery-lightbox__nav hotel-gallery-lightbox__nav--prev" data-gallery-prev aria-label="Предыдущее фото">‹</button>
        <figure>
            <img src="" alt="" data-gallery-preview>
            <figcaption data-gallery-caption></figcaption>
        </figure>
        <button type="button" class="hotel-gallery-lightbox__nav hotel-gallery-lightbox__nav--next" data-gallery-next aria-label="Следующее фото">›</button>
    </div>
</div>
@endsection
