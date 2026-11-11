@extends('layouts.app')

@push('styles')
    @if ($slides->first()?->image)
        <link rel="preload" as="image" fetchpriority="high" media="(max-width: 767px)" href="{{ \App\Support\ResponsiveImage::url(\App\Support\ImageVariants::url(($slides->first()->mobile_image ?: $slides->first()->image), 'hero'), 900) }}">
        <link rel="preload" as="image" fetchpriority="high" media="(min-width: 768px)" href="{{ \App\Support\ResponsiveImage::url(\App\Support\ImageVariants::url($slides->first()->image, 'hero'), 1920) }}">
    @endif
@endpush

@section('content')

@php
    $mainSlide = $slides->first();
@endphp
    @if(\App\Support\PageContent::visible($page, 'hero'))
<section class="hero d-block d-lg-flex align-items-center" id="hero"
        @if ($mainSlide?->image)
            style="--hero-image: url('{{ \App\Support\ResponsiveImage::url(\App\Support\ImageVariants::url($mainSlide->image, 'hero'), 1920) }}'); --hero-image-mobile: url('{{ \App\Support\ResponsiveImage::url(\App\Support\ImageVariants::url(($mainSlide->mobile_image ?: $mainSlide->image), 'hero'), 900) }}')"
        @endif
    >
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-8">
                    @if ($mainSlide)

                        <h1 class="hero__title text-white mb-4">
                            {{ $mainSlide->title }}
                        </h1>

                        @if ($mainSlide->description)
                            <p class="hero__text text-white mb-5">
                                {{ $mainSlide->description }}
                            </p>
                        @endif
                    @else
                        <h1 class="hero__title text-white mb-4">
                            Камерный отель<br>
                            в центре Геленджика
                        </h1>

                        <p class="hero__text text-white mb-5">
                            23 номера, парковка и завтраки в двух минутах
                            от набережной.
                        </p>
                    @endif

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ \App\Support\PageContent::link($page, 'hero_link_1') }}" class="btn btn-gold btn-lg px-5 py-3">
                            {!! nl2br(e(\App\Support\PageContent::text($page, 'hero_text_1'))) !!}
                        </a>

                        <a
                            class="watchVideo"
                            href="{{ \App\Support\PageContent::media($page, 'hero_video_1') }}"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="64"
                                height="64"
                                viewBox="0 0 64 64"
                                fill="none"
                                class="play-icon"
                            >
                                <circle
                                    cx="32"
                                    cy="32"
                                    r="30"
                                    stroke="#c9a66b"
                                    stroke-width="4"
                                />

                                <polygon
                                    points="25,20 25,44 48,32"
                                    fill="#ffffff"
                                />
                            </svg>

                            {!! nl2br(e(\App\Support\PageContent::text($page, 'hero_text_2'))) !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container Booking-Widget-box position-absolute start-50 translate-middle-x">
            <div class="booking-widget travelline-home-widget">
                <div id="tl-search-form" class="tl-container">
                    <noscript>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'hero_text_3'))) !!}
                    </noscript>
                </div>
            </div>
        </div>
    </section>
@endif

    @if(\App\Support\PageContent::visible($page, 'advantages-section'))
<section class="py-5 bg-light advantages-section">
        <div class="container pt-5">
            <div class="row g-4 text-center">
                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg
                            class="advantage-icon"
                            viewBox="0 0 32 32"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M16 29S26 19.9 26 11.8C26 6.4 21.5 2 16 2S6 6.4 6 11.8C6 19.9 16 29 16 29Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />

                            <circle
                                cx="16"
                                cy="12"
                                r="3.4"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_1'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_2'))) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg
                            class="advantage-icon"
                            viewBox="0 0 32 32"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M5 23V13.5C5 11.6 6.6 10 8.5 10H23.5C25.4 10 27 11.6 27 13.5V23"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M7 18H25"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />

                            <path
                                d="M9 18V14.8C9 13.8 9.8 13 10.8 13H14C15.1 13 16 13.9 16 15V18"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />

                            <path
                                d="M16 18V15C16 13.9 16.9 13 18 13H21.2C22.2 13 23 13.8 23 14.8V18"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />

                            <path
                                d="M5 25H27"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_3'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_4'))) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg
                            class="advantage-icon"
                            viewBox="0 0 32 32"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M8 9V15C8 19.4 11.6 23 16 23C20.4 23 24 19.4 24 15V9"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M6 9H26"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M24 12H26.5C28 12 29 13.2 28.7 14.7C28.3 16.9 26.4 18.5 24.2 18.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />

                            <path
                                d="M10 27H22"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_5'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_6'))) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg
                            class="advantage-icon"
                            viewBox="0 0 32 32"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M6 15.5H26L28 21V25H4V21L6 15.5Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M8.5 15.5L10.5 10H21.5L23.5 15.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />

                            <circle cx="9.5" cy="21.5" r="1.8" fill="currentColor" />
                            <circle cx="22.5" cy="21.5" r="1.8" fill="currentColor" />

                            <path
                                d="M7 25V27"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M25 25V27"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_7'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_8'))) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg
                            class="advantage-icon"
                            viewBox="0 0 32 32"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M13.5 18.5L7.5 24.5C6.1 25.9 3.8 25.9 2.5 24.5C1.1 23.1 1.1 20.9 2.5 19.5C3.8 18.1 6.1 18.1 7.5 19.5L13.5 13.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <circle
                                cx="21"
                                cy="11"
                                r="6"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />

                            <path
                                d="M25.2 15.2L29 19"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M20.2 11.8L17.7 9.3"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_9'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_10'))) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="first-icon">
                        <svg class="advantage-icon" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                            <rect x="5" y="3" width="15" height="25" rx="2" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M3 29H22M14 7L10 13H15L11 19M20 11H23C24.7 11 26 12.3 26 14V23C26 24.1 26.9 25 28 25C29.1 25 30 24.1 30 23V10L27 7M26 7V11H30" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div>
                            <div class="h5 advantage-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_11'))) !!}</div>
                            <div>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'advantages_section_text_12'))) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if(\App\Support\PageContent::visible($page, 'home-breakfast'))
<section class="home-breakfast">
    <div class="container">

        <div class="home-breakfast__grid">

            <div class="home-breakfast__content">

                <span class="home-breakfast__eyebrow">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_1'))) !!}
                </span>

                <h2 class="home-breakfast__title">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_2'))) !!}<br>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_3'))) !!}
                </h2>

                <p class="home-breakfast__text">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_4'))) !!}
                </p>



            </div>


            <div class="home-breakfast__media">

                <div class="home-breakfast__video">

                    <video
                        data-preview-video-src="{{ \App\Support\PageContent::media($page, 'home_breakfast_video_2') }}"
                        poster="{{ \App\Support\PageContent::media($page, 'home_breakfast_image_3', 1000) }}"
                        preload="none"
                        playsinline
                        data-breakfast-video
                    ></video>

                    <button
                        type="button"
                        class="home-breakfast__play"
                        data-breakfast-play
                        data-video-src="{{ \App\Support\PageContent::media($page, 'home_breakfast_video_2') }}"
                        aria-haspopup="dialog"
                        aria-controls="home-video-dialog"
                        aria-label="Смотреть видео"
                    >
                        <span class="home-breakfast__play-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 7l8 5-8 5V7Z"/>
                            </svg>
                        </span>

                        <span>
                            {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_5'))) !!}
                        </span>
                    </button>

                </div>


                <div class="home-breakfast__photos">

                    <div class="home-breakfast__photo">
                        <img
                            src="{{ \App\Support\PageContent::media($page, 'home_breakfast_image_4', 1000) }}"
                            alt="{{ \App\Support\PageContent::text($page, 'home_breakfast_alt_1') }}"
                            loading="lazy"
                        >
                    </div>

                    <div class="home-breakfast__photo">
                        <img
                            src="{{ \App\Support\PageContent::media($page, 'home_breakfast_image_5', 1000) }}"
                            alt="{{ \App\Support\PageContent::text($page, 'home_breakfast_alt_2') }}"
                            loading="lazy"
                        >
                    </div>

                </div>

            </div>

                <a href="{{ \App\Support\PageContent::link($page, 'home_breakfast_link_2') }}" class="home-breakfast__badge">

                    <svg viewBox="0 0 32 32" aria-hidden="true">
                        <path d="M8 10h13v7c0 4-3 7-7 7s-6-3-6-7v-7Z"/>
                        <path d="M21 12h2c3 0 5 2 5 5s-2 5-5 5h-3"/>
                        <path d="M6 27h19"/>
                        <path d="M11 7c0-2 2-2 2-5"/>
                        <path d="M16 7c0-2 2-2 2-5"/>
                    </svg>

                    <span>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'home_breakfast_text_6'))) !!} <span aria-hidden="true">→</span>
                    </span>

                </a>

        </div>

    </div>
</section>
@endif

    @if ($roomTypes->isNotEmpty())
        @if(\App\Support\PageContent::visible($page, 'rooms-home'))
<section class="rooms-home">
    <div class="container">

        <div class="rooms-home__head">
            <h2>{!! nl2br(e(\App\Support\PageContent::text($page, 'rooms_home_text_1'))) !!}</h2>

            <a href="{{ \App\Support\PageContent::link($page, 'rooms_home_link_3') }}" class="rooms-home__all">
                {!! nl2br(e(\App\Support\PageContent::text($page, 'rooms_home_text_2'))) !!}
                <span>→</span>
            </a>
        </div>

        <div class="rooms-home__grid">
            @foreach ($roomTypes->take(6) as $roomType)
                <a
                    href="{{ route('rooms.show', $roomType) }}"
                    class="rooms-home__card"
                >
                    <div class="rooms-home__image">
                        @if ($roomType->main_image)
                            <img
                                src="{{ \App\Support\ResponsiveImage::url(asset('storage/' . $roomType->main_image), 1000) }}"
                                alt="{{ $roomType->name }}"
                                loading="lazy"
                            >
                        @endif
                    </div>

                    <div class="rooms-home__body">
                        <h3>{{ $roomType->name }}</h3>

                        @if ($roomType->area)
                            <div class="rooms-home__meta">
                                {{ number_format($roomType->{!! nl2br(e(\App\Support\PageContent::text($page, 'rooms_home_text_3'))) !!}
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
@endif
        @endif

    @if(\App\Support\PageContent::visible($page, 'location-section'))
<section class="location-section" id="location">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6">
                    <img
                        src="{{ \App\Support\PageContent::media($page, 'location_section_image_6', 1000) }}"
                        class="img-fluid w-100 location-section__image"
                        alt="{{ \App\Support\PageContent::text($page, 'location_section_alt_3') }}"
                    >
                </div>

                <div class="col-lg-6 py-5 px-5 location-content">
                    <span
                        class="text-uppercase text-gold location-section__eyebrow"
                    >
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_1'))) !!}
                    </span>

                    <h2 class="display-5 mt-3 mb-4">
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_2'))) !!}
                    </h2>

                    <div class="location-list">
                        <div class="location-list__item">
                            <svg
                                class="location-list__icon"
                                viewBox="0 0 32 32"
                                fill="none"
                                aria-hidden="true"
                            >
                                <path
                                    d="M16 4L23 16H9L16 4Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M13 16V24H19V16"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M11 24H21"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M16 8V13"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M13.5 12H18.5"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                            </svg>

                            <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_3'))) !!}</span>
                        </div>

                        <div class="location-list__item">
                            <svg
                                class="location-list__icon"
                                viewBox="0 0 32 32"
                                fill="none"
                                aria-hidden="true"
                            >
                                <path
                                    d="M10 6V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M14 6V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M10 10H14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M12 14V26"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M22 6V26"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M22 6C18 8.5 18 13.5 22 16"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                            </svg>

                            <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_4'))) !!}</span>
                        </div>

                        <div class="location-list__item">
                            <svg
                                class="location-list__icon"
                                viewBox="0 0 32 32"
                                fill="none"
                                aria-hidden="true"
                            >
                                <path
                                    d="M16 24V13"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M16 18C12 18 9 15.5 9 12C9 8.8 11.8 6 16 6C20.2 6 23 8.8 23 12C23 15.5 20 18 16 18Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M16 18L12.5 14.5"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M16 18L19.5 14.5"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M10 26H22"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                            </svg>

                            <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_5'))) !!}</span>
                        </div>

                        <div class="location-list__item">
                            <svg
                                class="location-list__icon"
                                viewBox="0 0 32 32"
                                fill="none"
                                aria-hidden="true"
                            >
                                <path
                                    d="M8 24C8 24 10.5 20 14 20C17.5 20 18.5 24 22 24C25.5 24 27 20 27 20"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M8 26H26"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M11 16C11 16 16 11.5 16 7.5C16 4.95 13.95 3 11.5 3C9.05 3 7 4.95 7 7.5C7 11.5 11 16 11 16Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <circle
                                    cx="11.5"
                                    cy="7.5"
                                    r="1.7"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                                <path
                                    d="M22 18C22 18 26 14.3 26 11C26 8.8 24.2 7 22 7C19.8 7 18 8.8 18 11C18 14.3 22 18 22 18Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <circle
                                    cx="22"
                                    cy="11"
                                    r="1.45"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                            </svg>

                            <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_6'))) !!}</span>
                        </div>
                    </div>

                    <a
                        href="{{ \App\Support\PageContent::link($page, 'location_section_link_4') }}"
                        class="location-map-btn"
                    >
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'location_section_text_7'))) !!}

                        <svg
                            class="location-map-btn__icon"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M11 20C11 20 17 14.6 17 8.75C17 5.44 14.31 2.75 11 2.75C7.69 2.75 5 5.44 5 8.75C5 14.6 11 20 11 20Z"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <circle
                                cx="11"
                                cy="8.75"
                                r="2.15"
                                stroke="currentColor"
                                stroke-width="1.7"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

    @if(\App\Support\PageContent::visible($page, 'offers-home'))
<section class="offers-home">
    <div class="container">

        <div class="offers-home__head">
            <div>
                <span class="offers-home__eyebrow">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'offers_home_text_1'))) !!}
                </span>

                <h2>{!! nl2br(e(\App\Support\PageContent::text($page, 'offers_home_text_2'))) !!}</h2>
            </div>

            <a href="{{ \App\Support\PageContent::link($page, 'offers_home_link_5') }}" class="offers-home__all">
                {!! nl2br(e(\App\Support\PageContent::text($page, 'offers_home_text_3'))) !!}
                <span>→</span>
            </a>
        </div>

        @if ($promotions->isNotEmpty())

            <div class="offers-home__slider-wrap">

                <div class="offers-home__slider" data-offers-slider>

                    @foreach ($promotions as $promotion)

                        @php
                            $imageUrl = $promotion->image
                                ? asset('storage/' . $promotion->image)
                                : $promotion->legacy_image_url;

                            $excerpt = \Illuminate\Support\Str::of(
                                strip_tags($promotion->content ?? '')
                            )
                                ->replace('&nbsp;', ' ')
                                ->squish()
                                ->limit(105);
                        @endphp

                        <article class="offers-home__card">

                            <a
                                href="{{ route('offers.show', ['slug' => $promotion->slug]) }}"
                                class="offers-home__card-link"
                            >

                                <div class="offers-home__visual">

                                    <div class="offers-home__label">

                                        @if ($promotion->starts_at || $promotion->ends_at)

                                            <div class="offers-home__date">

                                                @if ($promotion->starts_at && $promotion->ends_at)

                                                    <strong>
                                                        {{ $promotion->starts_at->format('d') }}
                                                        —
                                                        {{ $promotion->ends_at->format('d') }}
                                                    </strong>

                                                    <span>
                                                        @if ($promotion->starts_at->format('m') === $promotion->ends_at->format('m'))
                                                            {{ mb_strtoupper($promotion->starts_at->translatedFormat('F')) }}
                                                        @else
                                                            {{ mb_strtoupper($promotion->starts_at->translatedFormat('F')) }}
                                                            —
                                                            {{ mb_strtoupper($promotion->ends_at->translatedFormat('F')) }}
                                                        @endif
                                                    </span>

                                                @elseif ($promotion->starts_at)

                                                    <strong>
                                                        с {{ $promotion->starts_at->format('d.m') }}
                                                    </strong>

                                                @elseif ($promotion->ends_at)

                                                    <strong>
                                                        до {{ $promotion->ends_at->format('d.m') }}
                                                    </strong>

                                                @endif

                                            </div>

                                        @else

                                            <div class="offers-home__date">
                                                <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'offers_home_text_4'))) !!}</span>
                                            </div>

                                        @endif

</div>

                                    <div class="offers-home__image">

                                        @if ($imageUrl)
                                            <img
                                                src="{{ \App\Support\ResponsiveImage::url($imageUrl, 1000) }}"
                                                alt="{{ $promotion->title }}"
                                                loading="lazy"
                                            >
                                        @endif

                                    </div>

                                </div>


                                <div class="offers-home__body">

                                    <div class="offers-home__title-row">

                                        <h3>
                                            {{ $promotion->title }}
                                        </h3>

                                        <span class="offers-home__arrow">
                                            ↗
                                        </span>

                                    </div>


                                    @if ($excerpt->isNotEmpty())
                                        <p>
                                            {{ $excerpt }}
                                        </p>
                                    @endif


                                    <span class="offers-home__more">
                                        {!! nl2br(e(\App\Support\PageContent::text($page, 'offers_home_text_5'))) !!}
                                        <span>→</span>
                                    </span>

                                </div>

                            </a>

                        </article>

                    @endforeach

                </div>


                @if ($promotions->count() > 3)

                    <div class="offers-home__nav">

                        <button
                            type="button"
                            class="offers-home__nav-btn"
                            data-offers-prev
                            aria-label="Предыдущие предложения"
                        >
                            ←
                        </button>

                        <button
                            type="button"
                            class="offers-home__nav-btn"
                            data-offers-next
                            aria-label="Следующие предложения"
                        >
                            →
                        </button>

                    </div>

                @endif

            </div>

        @endif

    </div>
</section>
@endif

    @if(\App\Support\PageContent::visible($page, 'guest-club-section'))
<section
        class="guest-club-section bg-green"
        id="club"
    >
        <div class="container">
            <div class="guest-club">
                <div class="guest-club__image">
                    <img
                        src="{{ \App\Support\PageContent::media($page, 'guest_club_section_image_7', 1000) }}"
                        alt="{{ \App\Support\PageContent::text($page, 'guest_club_section_alt_4') }}"
                        loading="lazy"
                    >
                </div>

                <div class="guest-club__content">
                    <span class="guest-club__label">
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_1'))) !!}
                    </span>

                    <h2 class="guest-club__title">
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_2'))) !!}<br>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_3'))) !!}
                    </h2>

                    <ul class="guest-club__list">
                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_4'))) !!}
                            </span>
                        </li>

                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_5'))) !!}
                            </span>
                        </li>

                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_6'))) !!}
                            </span>
                        </li>
                    </ul>

                    <a
                        href="{{ \App\Support\PageContent::link($page, 'guest_club_section_link_6') }}"
                        class="guest-club__btn"
                    >
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'guest_club_section_text_7'))) !!}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

    @if ($page)
        <div class="home-information">
            <div class="container">
                @include('pages.partials.blocks', ['blocks' => $page->blocks ?? []])
            </div>
        </div>
    @endif
    @include('partials.home-reviews')


    <dialog class="video-lightbox" id="home-video-dialog" data-video-lightbox aria-label="Видео об отеле">
        <button type="button" class="video-lightbox__close" data-video-close aria-label="Закрыть видео" autofocus>×</button>
        <div class="video-lightbox__content">
            <video controls playsinline preload="none" data-video-player></video>
        </div>
    </dialog>

@endsection




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('[data-offers-slider]');
    const prev = document.querySelector('[data-offers-prev]');
    const next = document.querySelector('[data-offers-next]');


    const videoLightbox = document.querySelector('[data-video-lightbox]');
    const videoPlayer = document.querySelector('[data-video-player]');
    const videoClose = document.querySelector('[data-video-close]');
    let videoOpener = null;

    const closeVideoLightbox = () => {
        if (videoLightbox?.open) videoLightbox.close();
    };

    document.querySelectorAll('.watchVideo, [data-breakfast-play]').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();
            if (!videoLightbox || !videoPlayer) return;
            const source = button.dataset.videoSrc || button.getAttribute('href');
            if (!source) return;
            videoOpener = button;
            document.querySelectorAll('video').forEach(video => video.pause());
            if (videoPlayer.getAttribute('src') !== source) {
                videoPlayer.src = source;
                videoPlayer.load();
            } else videoPlayer.currentTime = 0;
            videoLightbox.setAttribute('aria-label', button.matches('[data-breakfast-play]') ? 'Видео завтраков в отеле Лермонт' : 'Видео об отеле Лермонт');
            videoLightbox.showModal();
            videoLightbox.classList.add('is-open');
            document.body.classList.add('video-lightbox-open');
            videoPlayer.play().catch(() => { videoPlayer.controls = true; });
        });
    });
    videoClose?.addEventListener('click', closeVideoLightbox);
    videoLightbox?.addEventListener('click', event => {
        if (event.target === videoLightbox) closeVideoLightbox();
    });
    videoLightbox?.addEventListener('cancel', event => {
        event.preventDefault();
        closeVideoLightbox();
    });
    videoLightbox?.addEventListener('close', () => {
        videoPlayer?.pause();
        videoLightbox.classList.remove('is-open');
        document.body.classList.remove('video-lightbox-open');
        videoOpener?.focus({ preventScroll: true });
    });

    if (!slider) {
        return;
    }

    const getStep = () => {
        const card = slider.querySelector('.offers-home__card');

        if (!card) {
            return 400;
        }

        const gap = parseFloat(
            getComputedStyle(slider).columnGap
        ) || 0;

        return card.getBoundingClientRect().width + gap;
    };

    prev?.addEventListener('click', () => {
        slider.scrollBy({
            left: -getStep(),
            behavior: 'smooth',
        });
    });

    next?.addEventListener('click', () => {
        slider.scrollBy({
            left: getStep(),
            behavior: 'smooth',
        });
    });


});
</script>
@endpush
