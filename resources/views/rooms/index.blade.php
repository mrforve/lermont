@extends('layouts.app')

@section('title', 'Номера')

@section('content')

<style>
/* =========================================================
   ROOMS CATALOG
   ========================================================= */

.rooms-catalog {
    padding: 125px 0 100px;
    background: var(--cream);
}

.rooms-catalog__inner {
    max-width: 1280px;
    margin: 0 auto;
}


/* =========================================================
   TITLE
   ========================================================= */

.rooms-catalog__title {
    margin: 0 0 34px;

    color: var(--green);

    font-family: var(--serif);
    font-size: clamp(54px, 4.8vw, 78px);
    font-weight: 500;
    line-height: .92;
    letter-spacing: -.03em;

    text-transform: uppercase;
}


/* =========================================================
   ROOM TYPE TOGGLE
   ========================================================= */

.rooms-toggle {
    display: flex;
    flex-wrap: wrap;
    gap: 10px 28px;

    margin-bottom: 42px;

    border-bottom: 1px solid var(--line);
}

.rooms-toggle__button {
    position: relative;

    padding: 0 0 13px;

    border: 0;
    background: transparent;

    color: #9a9389;

    font-family: var(--sans);
    font-size: 13px;
    font-weight: 500;

    cursor: pointer;

    transition: color .2s ease;
}

.rooms-toggle__button::after {
    content: "";

    position: absolute;
    right: 100%;
    bottom: -1px;
    left: 0;

    height: 2px;

    background: var(--gold);

    transition: right .25s ease;
}

.rooms-toggle__button:hover,
.rooms-toggle__button.is-active {
    color: var(--green);
}

.rooms-toggle__button.is-active::after {
    right: 0;
}


/* =========================================================
   ROOM PANEL
   ========================================================= */

.room-showcase {
    display: none;
}

.room-showcase.is-active {
    display: block;

    animation: roomPanelIn .32s ease;
}

@keyframes roomPanelIn {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* =========================================================
   GALLERY
   ========================================================= */

.room-slider {
    position: relative;
}

.room-slider__stage {
    display: grid;
    grid-template-columns:
        minmax(0, 1.18fr)
        minmax(360px, .92fr);

    gap: 16px;
}

.room-slider__main,
.room-slider__side {
    position: relative;

    width: 100%;
    min-width: 0;

    overflow: hidden;

    background: var(--cream-2);
}

.room-slider__main {
    aspect-ratio: 1.56 / 1;
}

.room-slider__side {
    aspect-ratio: 1.38 / 1;

    cursor: pointer;
}

.room-slider__main .swiper-wrapper,
.room-slider__side .swiper-wrapper {
    width: 100%;
    height: 100%;
}

.room-slider__slide {
    width: 100%;
    height: 100%;

    overflow: hidden;
}

.room-slider__slide img {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;

    user-select: none;
    -webkit-user-drag: none;
}

.room-slider__side::after {
    content: "";

    position: absolute;
    inset: 0;
    z-index: 5;

    pointer-events: none;

    background:
        linear-gradient(
            90deg,
            rgba(24, 40, 32, .08),
            transparent 35%
        );
}

.room-slider__empty {
    display: flex;
    align-items: center;
    justify-content: center;

    min-height: 420px;

    color: var(--muted);

    font-size: 13px;

    background: var(--cream-2);
}


/* =========================================================
   HEADING
   ========================================================= */

.room-showcase__heading {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 72px;

    width: min(630px, 68%);
    min-height: 76px;

    border-bottom: 1px solid var(--line);

    background: var(--cream);
}

.room-showcase__heading h2 {
    display: flex;
    align-items: center;

    margin: 0;
    padding: 13px 24px 12px 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: 32px;
    font-weight: 500;
    line-height: .98;
    letter-spacing: -.025em;
}

.room-showcase__heading-link {
    display: flex;
    align-items: center;
    justify-content: center;

    background: var(--green);

    color: var(--gold) !important;

    text-decoration: none;

    transition:
        background-color .22s ease,
        color .22s ease;
}

.room-showcase__heading-link svg {
    width: 24px;
    height: 24px;

    fill: none;
    stroke: currentColor;
    stroke-width: 1.5;
    stroke-linecap: round;
    stroke-linejoin: round;

    transition: transform .25s ease;
}

.room-showcase__heading-link:hover {
    background: var(--green-deep);
    color: #fff !important;
}

.room-showcase__heading-link:hover svg {
    transform: translate(3px, -3px);
}


/* =========================================================
   GALLERY CONTROLS
   ========================================================= */

.room-slider__controls {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;

    min-height: 76px;

    padding-top: 16px;
}

.room-slider__button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;

    padding: 0;

    border: 1px solid var(--line);
    border-radius: 50%;

    background: transparent;

    color: var(--green);

    cursor: pointer;

    transition:
        color .2s ease,
        border-color .2s ease,
        background-color .2s ease,
        transform .2s ease;
}

.room-slider__button:hover {
    border-color: var(--gold);

    background: var(--gold);

    color: #fff;

    transform: translateY(-1px);
}

.room-slider__button svg {
    width: 18px;
    height: 18px;

    fill: none;
    stroke: currentColor;
    stroke-width: 1.6;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.room-slider__counter {
    min-width: 52px;

    color: var(--muted);

    font-family: var(--sans);
    font-size: 11px;

    text-align: center;
}


/* =========================================================
   ROOM INFO
   ========================================================= */

.room-showcase__info {
    display: grid;
    grid-template-columns:
        minmax(280px, .82fr)
        minmax(0, 1fr);

    gap: 70px;

    max-width: 940px;

    margin-top: 12px;
}

.room-showcase__facts {
    display: flex;
    flex-direction: column;
}

.room-showcase__fact {
    display: grid;
    grid-template-columns: 26px minmax(0, 1fr);
    gap: 12px;
    align-items: center;

    min-height: 58px;

    border-bottom: 1px solid var(--line);

    color: var(--text);

    font-size: 13px;
    line-height: 1.45;
}

.room-showcase__fact svg {
    width: 18px;
    height: 18px;

    fill: none;
    stroke: var(--green);
    stroke-width: 1.4;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.room-showcase__price {
    display: flex;
    align-items: baseline;
    gap: 6px;

    margin-top: 19px;

    color: var(--green);

    font-family: var(--serif);
    font-size: 27px;
    line-height: 1;
}

.room-showcase__price small {
    color: var(--muted);

    font-family: var(--sans);
    font-size: 11px;
}

.room-showcase__description {
    padding-top: 7px;

    color: #645e56;

    font-size: 14px;
    line-height: 1.72;
}

.room-showcase__description p {
    margin: 0 0 22px;
}


/* =========================================================
   MORE LINK
   ========================================================= */

.room-showcase__more {
    display: inline-flex;
    align-items: center;
    gap: 15px;

    min-height: 44px;

    margin-top: 5px;
    padding: 0 18px;

    border: 1px solid var(--gold);

    color: var(--gold-dark) !important;

    font-family: var(--sans);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .07em;

    text-transform: uppercase;
    text-decoration: none;

    transition:
        background-color .2s ease,
        color .2s ease,
        border-color .2s ease;
}

.room-showcase__more svg {
    width: 17px;
    height: 17px;

    fill: none;
    stroke: currentColor;
    stroke-width: 1.5;
    stroke-linecap: round;
    stroke-linejoin: round;

    transition: transform .2s ease;
}

.room-showcase__more:hover {
    border-color: var(--gold);

    background: var(--gold);

    color: #fff !important;
}

.room-showcase__more:hover svg {
    transform: translateX(3px);
}


/* =========================================================
   1200–1440
   ========================================================= */

@media (min-width: 1200px) and (max-width: 1440px) {

    .rooms-catalog {
        padding: 105px 0 70px;
    }

    .rooms-catalog__title {
        margin-bottom: 27px;

        font-size: 56px;
    }

    .rooms-toggle {
        gap: 8px 21px;

        margin-bottom: 32px;
    }

    .rooms-toggle__button {
        font-size: 12px;
    }

    .room-slider__stage {
        grid-template-columns:
            minmax(0, 1.17fr)
            minmax(310px, .92fr);

        gap: 13px;
    }

    .room-showcase__heading {
        grid-template-columns: minmax(0, 1fr) 62px;

        min-height: 64px;
    }

    .room-showcase__heading h2 {
        font-size: 26px;
    }

    .room-slider__controls {
        min-height: 62px;
    }

    .room-showcase__info {
        gap: 52px;

        margin-top: 7px;
    }

    .room-showcase__fact {
        min-height: 51px;

        font-size: 12px;
    }

    .room-showcase__description {
        font-size: 13px;
        line-height: 1.65;
    }

}


/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 1199px) {

    .rooms-catalog {
        padding: 100px 0 65px;
    }

    .room-slider__stage {
        grid-template-columns: 1.15fr .85fr;
    }

    .room-showcase__info {
        gap: 40px;
    }

}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 767px) {

    .rooms-catalog {
        padding: 90px 0 50px;
    }

    .rooms-catalog__title {
        margin-bottom: 23px;

        font-size: 43px;
    }

    .rooms-toggle {
        flex-wrap: nowrap;

        gap: 22px;

        margin-right: -14px;
        margin-bottom: 26px;
        padding-right: 14px;

        overflow-x: auto;
        overflow-y: hidden;

        scrollbar-width: none;
    }

    .rooms-toggle::-webkit-scrollbar {
        display: none;
    }

    .rooms-toggle__button {
        flex: 0 0 auto;

        white-space: nowrap;
    }

    .room-slider__stage {
        grid-template-columns: minmax(0, 1.75fr) minmax(105px, .65fr);

        gap: 7px;
    }

    .room-slider__main,
    .room-slider__side {
        aspect-ratio: auto;

        height: 320px;
    }

    .room-showcase__heading {
        grid-template-columns: minmax(0, 1fr) 56px;

        width: 100%;
        min-height: 60px;
    }

    .room-showcase__heading h2 {
        padding-left: 16px;

        font-size: 24px;
    }

    .room-slider__controls {
        justify-content: flex-start;

        min-height: 62px;
    }

    .room-showcase__info {
        grid-template-columns: 1fr;

        gap: 24px;

        margin-top: 10px;
    }

    .room-showcase__description {
        font-size: 13px;
    }

}


/* =========================================================
   SMALL MOBILE
   ========================================================= */

@media (max-width: 480px) {

    .room-slider__main,
    .room-slider__side {
        height: 265px;
    }

}
</style>


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


<script>
document.addEventListener('DOMContentLoaded', () => {

    const toggleButtons =
        document.querySelectorAll('[data-room-toggle]');

    const roomPanels =
        document.querySelectorAll('[data-room-panel]');


    /*
     * Переключение категорий
     */
    toggleButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const slug =
                button.dataset.roomToggle;


            toggleButtons.forEach((item) => {
                item.classList.remove('is-active');
            });


            roomPanels.forEach((panel) => {
                panel.classList.remove('is-active');
            });


            button.classList.add('is-active');


            const panel =
                document.querySelector(
                    `[data-room-panel="${slug}"]`
                );


            if (!panel) {
                return;
            }


            panel.classList.add('is-active');


            /*
             * Swiper создавался в скрытых блоках,
             * поэтому после открытия обновляем размеры.
             */
            requestAnimationFrame(() => {

                panel
                    .querySelectorAll('.swiper')
                    .forEach((element) => {

                        element.swiper?.update();

                    });

            });

        });

    });


    /*
     * Галереи
     */
    document
        .querySelectorAll('[data-room-slider]')
        .forEach((slider) => {

            if (typeof Swiper === 'undefined') {
                return;
            }


            const mainElement =
                slider.querySelector(
                    '[data-room-main-swiper]'
                );

            const sideElement =
                slider.querySelector(
                    '[data-room-side-swiper]'
                );


            if (!mainElement || !sideElement) {
                return;
            }


            const total =
                mainElement
                    .querySelectorAll('.swiper-slide')
                    .length;


            if (!total) {
                return;
            }


            const prevButton =
                slider.querySelector(
                    '[data-slider-prev]'
                );

            const nextButton =
                slider.querySelector(
                    '[data-slider-next]'
                );

            const counter =
                slider.querySelector(
                    '[data-slider-counter]'
                );


            /*
             * Главное фото
             */
            const mainSwiper =
                new Swiper(mainElement, {

                    slidesPerView: 1,

                    speed: 650,

                    loop: total > 1,

                    grabCursor: total > 1,

                    simulateTouch: true,

                    allowTouchMove: total > 1,

                    effect: 'creative',

                    creativeEffect: {

                        prev: {
                            translate: ['-100%', 0, 0],
                        },

                        next: {
                            translate: ['100%', 0, 0],
                            scale: .8,
                        },

                    },

                });


            /*
             * Правое превью.
             * Всегда показывает следующее фото.
             */
            const sideSwiper =
                new Swiper(sideElement, {

                    slidesPerView: 1,

                    speed: 650,

                    loop: total > 1,

                    initialSlide:
                        total > 1 ? 1 : 0,

                    allowTouchMove: false,

                    effect: 'creative',

                    creativeEffect: {

                        prev: {
                            translate: ['-100%', 0, 0],
                        },

                        next: {
                            translate: ['100%', 0, 0],
                            scale: .8,
                        },

                    },

                });


            let syncing = false;


            const update = () => {

                const current =
                    mainSwiper.realIndex;

                const next =
                    (current + 1) % total;


                if (counter) {
                    counter.textContent =
                        `${current + 1} / ${total}`;
                }


                if (
                    total > 1 &&
                    sideSwiper.realIndex !== next
                ) {

                    syncing = true;

                    sideSwiper.slideToLoop(
                        next,
                        650
                    );

                    setTimeout(() => {
                        syncing = false;
                    }, 670);

                }

            };


            /*
             * Главное фото можно свайпать.
             */
            mainSwiper.on(
                'slideChange',
                update
            );


            /*
             * Стрелки.
             */
            prevButton?.addEventListener(
                'click',
                () => {

                    mainSwiper.slidePrev();

                }
            );


            nextButton?.addEventListener(
                'click',
                () => {

                    mainSwiper.slideNext();

                }
            );


            /*
             * Клик по правому фото =
             * перейти к нему.
             */
            sideElement.addEventListener(
                'click',
                () => {

                    if (
                        total > 1 &&
                        !syncing
                    ) {
                        mainSwiper.slideNext();
                    }

                }
            );


            update();

        });

});
</script>

@endsection