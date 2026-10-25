@extends('layouts.app')

@section('title', 'Номера')

@section('content')

<section class="rooms-catalog">

    <div class="container">

        <div class="rooms-catalog__inner">

            @if ($roomTypes->isEmpty())

                <p>Типы номеров пока не добавлены.</p>

            @else

                <h1 class="rooms-catalog__title">
                    Номера
                </h1>


                <div class="rooms-toggle">

                    @foreach ($roomTypes as $roomType)

                        <button
                            type="button"
                            class="rooms-toggle__button {{ $loop->first ? 'is-active' : '' }}"
                            data-room-toggle="{{ $roomType->slug }}"
                        >
                            {{ $roomType->name }}
                        </button>

                    @endforeach

                </div>


                @foreach ($roomTypes as $roomType)

                    @php
                        $sliderImages = collect();

                        if ($roomType->main_image) {
                            $sliderImages->push([
                                'src' => asset('storage/' . $roomType->main_image),
                                'alt' => $roomType->name,
                            ]);
                        }

                        foreach ($roomType->images->where('is_active', true) as $image) {
                            if (! $image->image) {
                                continue;
                            }

                            $src = asset('storage/' . $image->image);

                            if (! $sliderImages->contains('src', $src)) {
                                $sliderImages->push([
                                    'src' => $src,
                                    'alt' => $image->alt ?: $roomType->name,
                                ]);
                            }
                        }

                        $totalCapacity =
                            (int) $roomType->capacity +
                            (int) $roomType->extra_capacity;
                    @endphp


                    <article
                        class="room-showcase {{ $loop->first ? 'is-active' : '' }}"
                        data-room-panel="{{ $roomType->slug }}"
                    >

                        <div
                            class="room-slider"
                            data-room-slider
                        >

                            @if ($sliderImages->isNotEmpty())

                                <div class="room-slider__stage">


                                    {{-- Основное изображение --}}
                                    <div
                                        class="room-slider__main swiper"
                                        data-room-main-swiper
                                    >

                                        <div class="swiper-wrapper">

                                            @foreach ($sliderImages as $image)

                                                <div class="swiper-slide room-slider__slide">

                                                    <img
                                                        src="{{ $image['src'] }}"
                                                        alt="{{ $image['alt'] }}"
                                                        data-swiper-parallax-x="8%"
                                                        data-swiper-parallax-scale="1.18"
                                                        loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                                    >

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>


                                    {{-- Следующее изображение --}}
                                    <div
                                        class="room-slider__side swiper"
                                        data-room-side-swiper
                                        aria-label="Следующее изображение"
                                    >

                                        <div class="swiper-wrapper">

                                            @foreach ($sliderImages as $image)

                                                <div class="swiper-slide room-slider__slide">

                                                    <img
                                                        src="{{ $image['src'] }}"
                                                        alt="{{ $image['alt'] }}"
                                                        data-swiper-parallax-x="8%"
                                                        data-swiper-parallax-scale="1.18"
                                                        loading="lazy"
                                                    >

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            @else

                                <div class="room-slider__empty">
                                    Нет изображения
                                </div>

                            @endif


                            <div class="room-showcase__heading">

                                <h2>
                                    {{ $roomType->name }}
                                </h2>

                                <a
                                    href="{{ route('rooms.show', $roomType) }}"
                                    class="room-showcase__heading-link"
                                    aria-label="Подробнее о номере {{ $roomType->name }}"
                                >
                                    <svg viewBox="0 0 24 24">
                                        <path d="M7 17 17 7"/>
                                        <path d="M8 7h9v9"/>
                                    </svg>
                                </a>

                            </div>


                            @if ($sliderImages->count() > 1)

                                <div class="room-slider__controls">

                                    <button
                                        type="button"
                                        class="room-slider__button"
                                        data-slider-prev
                                        aria-label="Предыдущее изображение"
                                    >
                                        <svg viewBox="0 0 24 24">
                                            <path d="m15 18-6-6 6-6"/>
                                        </svg>
                                    </button>


                                    <div
                                        class="room-slider__counter"
                                        data-slider-counter
                                    >
                                        1 / {{ $sliderImages->count() }}
                                    </div>


                                    <button
                                        type="button"
                                        class="room-slider__button"
                                        data-slider-next
                                        aria-label="Следующее изображение"
                                    >
                                        <svg viewBox="0 0 24 24">
                                            <path d="m9 18 6-6-6-6"/>
                                        </svg>
                                    </button>

                                </div>

                            @endif

                        </div>


                        <div class="room-showcase__info">

                            <div class="room-showcase__facts">

                                @if ($totalCapacity)

                                    <div class="room-showcase__fact">

                                        <svg viewBox="0 0 24 24">
                                            <circle cx="12" cy="7" r="3"/>
                                            <path d="M6 21v-3a6 6 0 0 1 12 0v3"/>
                                        </svg>

                                        <span>
                                            До {{ $totalCapacity }} гостей
                                        </span>

                                    </div>

                                @endif


                                @if ($roomType->area)

                                    <div class="room-showcase__fact">

                                        <svg viewBox="0 0 24 24">
                                            <path d="M4 4h6M4 4v6"/>
                                            <path d="M20 20h-6M20 20v-6"/>
                                            <path d="M4 20 20 4"/>
                                        </svg>

                                        <span>
                                            {{ number_format($roomType->area, 0, ',', ' ') }} м²
                                        </span>

                                    </div>

                                @endif


                                @if ($roomType->base_price)

                                    <div class="room-showcase__price">

                                        <small>от</small>

                                        {{ number_format(
                                            $roomType->base_price,
                                            0,
                                            ',',
                                            ' '
                                        ) }} ₽

                                    </div>

                                @endif

                            </div>


                            <div class="room-showcase__description">

                                @if ($roomType->short_description)

                                    <p>
                                        {{ $roomType->short_description }}
                                    </p>

                                @endif


                                <a
                                    href="{{ route('rooms.show', $roomType) }}"
                                    class="room-showcase__more"
                                >
                                    Подробнее о номере

                                    <svg viewBox="0 0 24 24">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            @endif

        </div>

    </div>

</section>




@endsection