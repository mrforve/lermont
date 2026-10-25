@extends('layouts.app')

@section('content')

@php
    $mainSlide = $slides->first();
@endphp
    <section class="hero d-block d-lg-flex align-items-center" id="hero" 
        @if ($mainSlide?->image)
            style="
                background-image:
                    linear-gradient(
                        90deg,
                        rgba(15, 31, 26, 0.72) 0%,
                        rgba(15, 31, 26, 0.28) 55%,
                        rgba(15, 31, 26, 0.08) 100%
                    ),
                    url('{{ \App\Support\ImageVariants::url($mainSlide->image, 'hero') }}');
            "
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
                        <a href="{{ route('booking') }}" class="btn btn-gold btn-lg px-5 py-3">
                            ПРОВЕРИТЬ ДАТЫ
                        </a>

                        <a
                            class="watchVideo"
                            href="{{ asset('img/sdf.mp4') }}"
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

                            СМОТРЕТЬ ВИДЕО
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container Booking-Widget-box position-absolute start-50 translate-middle-x">
            <div class="booking-widget travelline-home-widget">
                <div id="tl-search-form" class="tl-container">
                    <noscript>
                        Для поиска номеров включите JavaScript в браузере.
                    </noscript>
                </div>
            </div>
        </div>
            </div>
        </div>
    </section>

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
                            <h5>ЦЕНТР ГОРОДА</h5>
                            <div>
                                Набережная, рестораны и парки в шаговой доступности.
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
                            <h5>23 НОМЕРА</h5>
                            <div>
                                Просторные номера разных категорий.
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
                            <h5>ЗАВТРАКИ</h5>
                            <div>
                                Включены в проживание.
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
                            <h5>ПАРКОВКА</h5>
                            <div>
                                Бесплатная напротив отеля.
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
                            <h5>КЛУБ ГОСТЕЙ</h5>
                            <div>
                                Привилегии для постоянных гостей.
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
                                d="M16 3L19.8 10.7L28.3 12L22.1 18L23.6 26.5L16 22.5L8.4 26.5L9.9 18L3.7 12L12.2 10.7L16 3Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />
                        </svg>

                        <div>
                            <h5>СИСТЕМА ЛОЯЛЬНОСТИ</h5>
                            <div>
                                Привилегии и специальные предложения.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
<section class="home-breakfast">
    <div class="container">

        <div class="home-breakfast__grid">

            <div class="home-breakfast__content">

                <span class="home-breakfast__eyebrow">
                    ДОБРОЕ УТРО В «ЛЕРМОНТЕ»
                </span>

                <h2 class="home-breakfast__title">
                    Утро начинается<br>
                    в «Лермонте»
                </h2>

                <p class="home-breakfast__text">
                    Шведский стол, любимые блюда
                    и время для себя.
                </p>

                <a href="/breakfast" class="home-breakfast__badge">

                    <svg viewBox="0 0 32 32" aria-hidden="true">
                        <path d="M8 10h13v7c0 4-3 7-7 7s-6-3-6-7v-7Z"/>
                        <path d="M21 12h2c3 0 5 2 5 5s-2 5-5 5h-3"/>
                        <path d="M6 27h19"/>
                        <path d="M11 7c0-2 2-2 2-5"/>
                        <path d="M16 7c0-2 2-2 2-5"/>
                    </svg>

                    <span>
                        О наших завтраках
                    </span>

                </a>

            </div>


            <div class="home-breakfast__media">

                <div class="home-breakfast__video">

                    <video
                        src="{{ asset('img/breakfast.mp4') }}"
                        poster="{{ asset('img/KIR_4324.jpg') }}"
                        preload="metadata"
                        playsinline
                        data-breakfast-video
                    ></video>

                    <button
                        type="button"
                        class="home-breakfast__play"
                        data-breakfast-play
                        aria-label="Смотреть видео"
                    >
                        <span class="home-breakfast__play-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 7l8 5-8 5V7Z"/>
                            </svg>
                        </span>

                        <span>
                            Смотреть видео
                        </span>
                    </button>

                </div>


                <div class="home-breakfast__photos">

                    <div class="home-breakfast__photo">
                        <img
                            src="{{ asset('img/KIR_4350.jpg') }}"
                            alt="Завтрак в отеле Лермонт"
                            loading="lazy"
                        >
                    </div>

                    <div class="home-breakfast__photo">
                        <img
                            src="{{ asset('img/KIR_4324.jpg') }}"
                            alt="Зона завтрака в отеле Лермонт"
                            loading="lazy"
                        >
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

    @if ($roomTypes->isNotEmpty())
        <section class="rooms-home">
    <div class="container">

        <div class="rooms-home__head">
            <h2>Выберите свой номер</h2>

            <a href="{{ route('rooms.index') }}" class="rooms-home__all">
                Все номера
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
                                src="{{ asset('storage/' . $roomType->main_image) }}"
                                alt="{{ $roomType->name }}"
                                loading="lazy"
                            >
                        @endif
                    </div>

                    <div class="rooms-home__body">
                        <h3>{{ $roomType->name }}</h3>

                        @if ($roomType->area)
                            <div class="rooms-home__meta">
                                {{ number_format($roomType->area, 0, ',', ' ') }} м²
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
        @endif

    <section class="location-section" id="location">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6">
                    <img
                        src="{{ asset('img/07c7bba161a1.jpg') }}"
                        class="img-fluid w-100"
                        alt="Набережная Геленджика"
                        style="height: 560px; object-fit: cover;"
                    >
                </div>

                <div class="col-lg-6 py-5 px-5 location-content">
                    <span
                        class="text-uppercase text-gold"
                        style="letter-spacing: 2px;"
                    >
                        ЛОКАЦИЯ —
                    </span>

                    <h2 class="display-5 mt-3 mb-4">
                        В самом сердце Геленджика
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

                            <span>2 минуты до набережной</span>
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

                            <span>Рестораны и кафе рядом</span>
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

                            <span>Парки и скверы в шаговой доступности</span>
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

                            <span>Удобная транспортная доступность</span>
                        </div>
                    </div>

                    <a
                        href="#contacts"
                        class="location-map-btn"
                    >
                        Посмотреть на карте

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

    <section class="offers-home">
    <div class="container">

        <div class="offers-home__head">
            <div>
                <span class="offers-home__eyebrow">
                    Для наших гостей
                </span>

                <h2>Спецпредложения и акции</h2>
            </div>

            <a href="{{ route('offers.index') }}" class="offers-home__all">
                Все предложения
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
                                                <span>СПЕЦПРЕДЛОЖЕНИЕ</span>
                                            </div>

                                        @endif

</div>

                                    <div class="offers-home__image">

                                        @if ($imageUrl)
                                            <img
                                                src="{{ $imageUrl }}"
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
                                        Подробнее
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

    <section
        class="guest-club-section bg-green"
        id="club"
    >
        <div class="container">
            <div class="guest-club">
                <div class="guest-club__image">
                    <img
                        src="{{ asset('img/82db-8558b51a0d11.jpg') }}"
                        alt="Клуб гостей Лермонт"
                        loading="lazy"
                    >
                </div>

                <div class="guest-club__content">
                    <span class="guest-club__label">
                        Клуб гостей
                    </span>

                    <h2 class="guest-club__title">
                        Привилегии для тех,<br>
                        кто выбирает Лермонт
                    </h2>

                    <ul class="guest-club__list">
                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                Специальные тарифы только на сайте
                            </span>
                        </li>

                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                Ранний заезд и поздний выезд
                            </span>
                        </li>

                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                Персональные предложения
                            </span>
                        </li>

                        <li>
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12.5L9.5 17L19 7" />
                            </svg>

                            <span>
                                Подарки и комплименты от отеля
                            </span>
                        </li>
                    </ul>

                    <a
                        href="{{ route('register') }}"
                        class="guest-club__btn"
                    >
                        Вступить в клуб
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if ($page)
        @include('pages.partials.blocks', [
            'blocks' => $page->blocks ?? [],
        ])
    @endif


    <div class="video-lightbox" data-video-lightbox>
    <button
        type="button"
        class="video-lightbox__close"
        data-video-close
        aria-label="Закрыть видео"
    >
        ×
    </button>

    <div class="video-lightbox__content">
        <video
            controls
            playsinline
            preload="metadata"
            data-video-player
        >
            <source
                src="{{ asset('img/sdf.mp4') }}"
                type="video/mp4"
            >
        </video>
    </div>
</div>

@endsection




<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('[data-offers-slider]');
    const prev = document.querySelector('[data-offers-prev]');
    const next = document.querySelector('[data-offers-next]');


    const videoLightbox =
    document.querySelector('[data-video-lightbox]');

const videoPlayer =
    document.querySelector('[data-video-player]');

const videoClose =
    document.querySelector('[data-video-close]');

document
    .querySelectorAll('.watchVideo')
    .forEach((button) => {

        button.addEventListener('click', (event) => {

            event.preventDefault();

            if (!videoLightbox || !videoPlayer) {
                return;
            }

            videoLightbox.classList.add('is-open');

            document.body.classList.add(
                'video-lightbox-open'
            );

            videoPlayer.currentTime = 0;

            videoPlayer.play();

        });

    });


const closeVideoLightbox = () => {

    if (!videoLightbox || !videoPlayer) {
        return;
    }

    videoPlayer.pause();

    videoLightbox.classList.remove('is-open');

    document.body.classList.remove(
        'video-lightbox-open'
    );

};


videoClose?.addEventListener(
    'click',
    closeVideoLightbox
);


videoLightbox?.addEventListener(
    'click',
    (event) => {

        if (event.target === videoLightbox) {
            closeVideoLightbox();
        }

    }
);


document.addEventListener(
    'keydown',
    (event) => {

        if (
            event.key === 'Escape' &&
            videoLightbox?.classList.contains('is-open')
        ) {
            closeVideoLightbox();
        }

    }
);

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

    const breakfastVideo =
    document.querySelector('[data-breakfast-video]');

const breakfastPlay =
    document.querySelector('[data-breakfast-play]');

if (breakfastVideo && breakfastPlay) {

    breakfastPlay.addEventListener('click', () => {

        if (breakfastVideo.paused) {

            breakfastVideo.play();

            breakfastPlay.style.opacity = '0';
            breakfastPlay.style.pointerEvents = 'none';

        } else {

            breakfastVideo.pause();

        }

    });


    breakfastVideo.addEventListener('click', () => {

        if (!breakfastVideo.paused) {

            breakfastVideo.pause();

            breakfastPlay.style.opacity = '1';
            breakfastPlay.style.pointerEvents = '';

        }

    });


    breakfastVideo.addEventListener('ended', () => {

        breakfastPlay.style.opacity = '1';
        breakfastPlay.style.pointerEvents = '';

    });

}

});
</script>