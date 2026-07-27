@extends('layouts.app')

@section(
    'title',
    $roomType->seo_title ?: $roomType->name
)

@section(
    'meta_description',
    $roomType->seo_description ?: $roomType->short_description
)

@section('content')
    <article class="room-page">
        <div class="container">
            <a
                href="{{ route('rooms.index') }}"
                class="room-page__back"
            >
                ← Все номера
            </a>

            <header class="room-page__header">
                <div>
                    <h1>{{ $roomType->name }}</h1>

                    <div class="room-page__meta">
                        @if ($roomType->capacity)
                            <span>
                                Основных мест: {{ $roomType->capacity }}
                            </span>
                        @endif

                        @if ($roomType->extra_capacity)
                            <span>
                                Дополнительных мест:
                                {{ $roomType->extra_capacity }}
                            </span>
                        @endif

                        @if ($roomType->area)
                            <span>
                                Площадь:
                                {{ number_format($roomType->area, 0, ',', ' ') }}
                                м²
                            </span>
                        @endif
                    </div>
                </div>

                @if ($roomType->base_price)
                    <div class="room-page__price">
                        <span>от</span>

                        <strong>
                            {{ number_format($roomType->base_price, 0, ',', ' ') }}
                            ₽
                        </strong>

                        <span>за ночь</span>
                    </div>
                @endif
            </header>

            <section
                class="room-gallery"
                data-room-gallery
            >
                @if ($roomType->main_image)
                    <button
                        type="button"
                        class="room-gallery__main"
                        data-lightbox-image="{{ asset('storage/' . $roomType->main_image) }}"
                        data-lightbox-alt="{{ $roomType->name }}"
                        aria-label="Открыть изображение: {{ $roomType->name }}"
                    >
                        <img
                            src="{{ asset('storage/' . $roomType->main_image) }}"
                            alt="{{ $roomType->name }}"
                        >
                    </button>
                @endif

                @foreach ($roomType->images as $image)
                    <button
                        type="button"
                        class="room-gallery__item"
                        data-lightbox-image="{{ asset('storage/' . $image->image) }}"
                        data-lightbox-alt="{{ $image->alt ?: $roomType->name }}"
                        aria-label="Открыть изображение: {{ $image->alt ?: $roomType->name }}"
                    >
                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $image->alt ?: $roomType->name }}"
                            loading="lazy"
                        >
                    </button>
                @endforeach
            </section>

            <div
                class="room-lightbox"
                data-room-lightbox
                aria-hidden="true"
            >
                <div
                    class="room-lightbox__backdrop"
                    data-lightbox-close
                ></div>

                <div
                    class="room-lightbox__dialog"
                    role="dialog"
                    aria-modal="true"
                    aria-label="Просмотр фотографии"
                >
                    <button
                        type="button"
                        class="room-lightbox__close"
                        data-lightbox-close
                        aria-label="Закрыть"
                    >
                        ×
                    </button>

                    <button
                        type="button"
                        class="room-lightbox__arrow room-lightbox__arrow--prev"
                        data-lightbox-prev
                        aria-label="Предыдущее изображение"
                    >
                        ‹
                    </button>

                    <img
                        src=""
                        alt=""
                        class="room-lightbox__image"
                        data-lightbox-preview
                    >

                    <button
                        type="button"
                        class="room-lightbox__arrow room-lightbox__arrow--next"
                        data-lightbox-next
                        aria-label="Следующее изображение"
                    >
                        ›
                    </button>

                    <div
                        class="room-lightbox__caption"
                        data-lightbox-caption
                    ></div>
                </div>
            </div>

            @if ($roomType->description)
                <section class="room-page__description">
                    {!! $roomType->description !!}
                </section>
            @endif

            @if ($roomType->amenities->isNotEmpty())
                <section class="room-page__section">
                    <h2>Удобства</h2>

                    <div class="room-amenities">
                        @foreach ($roomType->amenities as $amenity)
                            <div class="room-amenity">
                                @if ($amenity->icon)
                                    <span class="room-amenity__icon">
                                        {{ $amenity->icon }}
                                    </span>
                                @endif

                                <span>{{ $amenity->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($roomType->rooms->isNotEmpty())
                <section class="room-page__section">
                    <h2>Номера этой категории</h2>

                    <div class="room-numbers">
                        @foreach ($roomType->rooms as $room)
                            <div class="room-number">
                                <strong>
                                    {{ $room->name ?: 'Номер ' . $room->number }}
                                </strong>

                                @if ($room->building || $room->floor)
                                    <span>
                                        @if ($room->building)
                                            Корпус: {{ $room->building }}
                                        @endif

                                        @if ($room->building && $room->floor)
                                            ·
                                        @endif

                                        @if ($room->floor)
                                            Этаж: {{ $room->floor }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="room-page__request">
                @include('partials.contact-form', [
                    'type' => \App\Models\ContactRequest::TYPE_QUESTION,
                    'title' => 'Уточнить условия проживания',
                ])
            </section>
        </div>
    </article>
@endsection