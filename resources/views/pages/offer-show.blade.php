@extends('layouts.app')

@section('title', $promotion->title)

@section('content')

@php
    $imageUrl = $promotion->image
        ? asset('storage/' . $promotion->image)
        : $promotion->legacy_image_url;

    $buttonText = $promotion->button_text ?: 'Забронировать номер';
    $buttonUrl = $promotion->button_url ?: route('booking');
@endphp

<style>
    .offer-detail {
        padding: 120px 0 90px;
        background: var(--cream);
    }

    .offer-detail__back {
        display: inline-flex;
        align-items: center;
        gap: 10px;

        margin-bottom: 34px;

        color: var(--gold-dark);

        font-family: var(--sans);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;

        text-decoration: none;
        text-transform: uppercase;
    }

    .offer-detail__back:hover {
        color: var(--green);
    }

    .offer-detail__hero {
        display: grid;
        grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);

        min-height: 560px;

        margin-bottom: 54px;

        background: var(--green);
    }

    .offer-detail__hero-content {
        display: flex;
        flex-direction: column;
        justify-content: center;

        padding: 56px 58px;
    }

    .offer-detail__label {
        margin-bottom: 18px;

        color: var(--gold);

        font-family: var(--sans);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .18em;

        text-transform: uppercase;
    }

    .offer-detail__title {
        margin: 0 0 26px;

        color: #fff;

        font-family: var(--serif);
        font-size: clamp(52px, 5vw, 76px);
        font-weight: 500;
        line-height: .92;
        letter-spacing: -.03em;
    }

    .offer-detail__lead {
        max-width: 520px;

        color: rgba(255, 255, 255, .74);

        font-family: var(--sans);
        font-size: 15px;
        line-height: 1.7;
    }

    .offer-detail__hero-image {
        position: relative;

        overflow: hidden;

        background: var(--green-deep);
    }

    .offer-detail__hero-image::after {
        content: "";
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                90deg,
                rgba(36, 56, 45, .28) 0%,
                transparent 28%
            );

        pointer-events: none;
    }

    .offer-detail__hero-image img {
        display: block;

        width: 100%;
        height: 100%;

        object-fit: cover;
    }


    /* CONTENT */

    .offer-detail__main {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 70px;

        max-width: 1180px;
        margin: 0 auto;
    }

    .offer-detail__content {
        color: #5d574f;

        font-family: var(--sans);
        font-size: 16px;
        line-height: 1.8;
    }

    .offer-detail__content > *:first-child {
        margin-top: 0;
    }

    .offer-detail__content p {
        margin: 0 0 22px;
    }

    .offer-detail__content strong {
        color: var(--green);
        font-weight: 700;
    }

    .offer-detail__content h2,
    .offer-detail__content h3 {
        margin: 42px 0 18px;

        color: var(--green);

        font-family: var(--serif);
        font-weight: 500;
        line-height: 1;
    }

    .offer-detail__content h2 {
        font-size: 42px;
    }

    .offer-detail__content h3 {
        font-size: 32px;
    }

    .offer-detail__content ul,
    .offer-detail__content ol {
        margin: 20px 0 26px;
        padding-left: 22px;
    }

    .offer-detail__content li {
        margin-bottom: 8px;
    }


    /* SIDEBAR */

    .offer-detail__aside {
        align-self: start;

        position: sticky;
        top: 110px;
    }

    .offer-detail__box {
        padding: 30px;

        background: #fff;

        border: 1px solid var(--line);

        box-shadow: 0 16px 38px rgba(24, 40, 32, .08);
    }

    .offer-detail__box-label {
        display: block;

        margin-bottom: 12px;

        color: var(--gold);

        font-family: var(--sans);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .16em;

        text-transform: uppercase;
    }

    .offer-detail__box-title {
        margin: 0 0 22px;

        color: var(--green);

        font-family: var(--serif);
        font-size: 30px;
        font-weight: 500;
        line-height: 1;
    }

    .offer-detail__box-text {
        margin-bottom: 24px;

        color: var(--muted);

        font-size: 13px;
        line-height: 1.6;
    }

    .offer-detail__button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;

        width: 100%;

        padding: 16px 18px;

        background: linear-gradient(
            180deg,
            #d3ad75 0%,
            #b98b50 100%
        );

        border: 1px solid rgba(255, 255, 255, .12);

        color: #fff !important;

        font-family: var(--sans);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .08em;

        text-decoration: none;
        text-transform: uppercase;

        box-shadow: 0 12px 28px rgba(185, 139, 80, .22);

        transition:
            background .2s ease,
            transform .2s ease;
    }

    .offer-detail__button:hover {
        background: var(--gold-dark);
        transform: translateY(-1px);
    }

    .offer-detail__button-arrow {
        font-size: 20px;
        line-height: 1;
    }


    /* META BLOCK */

    .offer-detail__meta {
        display: grid;
        grid-template-columns: repeat(3, 1fr);

        gap: 1px;

        margin-top: 48px;

        background: var(--line);
        border: 1px solid var(--line);
    }

    .offer-detail__meta-item {
        padding: 24px;

        background: #fff;
    }

    .offer-detail__meta-label {
        display: block;

        margin-bottom: 8px;

        color: var(--gold-dark);

        font-size: 10px;
        font-weight: 700;
        letter-spacing: .14em;

        text-transform: uppercase;
    }

    .offer-detail__meta-value {
        color: var(--green);

        font-family: var(--serif);
        font-size: 24px;
        line-height: 1.05;
    }


    /* 1366 */

    @media (min-width: 992px) and (max-width: 1440px) {
        .offer-detail {
            padding: 100px 0 68px;
        }

        .offer-detail__back {
            margin-bottom: 24px;
        }

        .offer-detail__hero {
            min-height: 430px;
            margin-bottom: 42px;
        }

        .offer-detail__hero-content {
            padding: 38px 42px;
        }

        .offer-detail__title {
            font-size: 54px;
        }

        .offer-detail__lead {
            font-size: 14px;
        }

        .offer-detail__main {
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 50px;
        }

        .offer-detail__content {
            font-size: 14px;
            line-height: 1.7;
        }

        .offer-detail__box {
            padding: 24px;
        }

        .offer-detail__box-title {
            font-size: 26px;
        }

        .offer-detail__meta {
            margin-top: 36px;
        }

        .offer-detail__meta-item {
            padding: 18px;
        }

        .offer-detail__meta-value {
            font-size: 21px;
        }
    }


    /* TABLET */

    @media (max-width: 991px) {
        .offer-detail {
            padding: 92px 0 60px;
        }

        .offer-detail__hero {
            grid-template-columns: 1fr;
        }

        .offer-detail__hero-content {
            padding: 38px 30px;
        }

        .offer-detail__title {
            font-size: 48px;
        }

        .offer-detail__hero-image {
            min-height: 360px;
        }

        .offer-detail__main {
            grid-template-columns: 1fr;
            gap: 36px;
        }

        .offer-detail__aside {
            position: static;
        }
    }


    /* MOBILE */

    @media (max-width: 575px) {
        .offer-detail {
            padding: 88px 0 48px;
        }

        .offer-detail__hero {
            min-height: 0;
            margin-bottom: 30px;
        }

        .offer-detail__hero-content {
            padding: 30px 22px;
        }

        .offer-detail__title {
            font-size: 40px;
        }

        .offer-detail__lead {
            font-size: 13px;
        }

        .offer-detail__hero-image {
            min-height: 260px;
        }

        .offer-detail__content {
            font-size: 14px;
        }

        .offer-detail__meta {
            grid-template-columns: 1fr;
        }

        .offer-detail__box {
            padding: 24px 20px;
        }
    }
</style>


<article class="offer-detail">

    <div class="container">

        <a
            href="{{ route('offers.index') }}"
            class="offer-detail__back"
        >
            ← Все акции
        </a>


        <section class="offer-detail__hero">

            <div class="offer-detail__hero-content">

                <span class="offer-detail__label">
                    Специальное предложение
                </span>

                <h1 class="offer-detail__title">
                    {{ $promotion->title }}
                </h1>

                <div class="offer-detail__lead">
                    Специальные условия для гостей отеля «Лермонт».
                    Забронируйте отдых напрямую и воспользуйтесь преимуществами предложения.
                </div>

            </div>


            @if ($imageUrl)

                <div class="offer-detail__hero-image">

                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $promotion->title }}"
                    >

                </div>

            @endif

        </section>


        <div class="offer-detail__main">

            <div>

                <div class="offer-detail__content">
                    {!! $promotion->content !!}
                </div>


                <div class="offer-detail__meta">

                    <div class="offer-detail__meta-item">

                        <span class="offer-detail__meta-label">
                            Формат
                        </span>

                        <div class="offer-detail__meta-value">
                            Спецпредложение
                        </div>

                    </div>


                    <div class="offer-detail__meta-item">

                        <span class="offer-detail__meta-label">
                            Бронирование
                        </span>

                        <div class="offer-detail__meta-value">
                            Напрямую в отеле
                        </div>

                    </div>


                    <div class="offer-detail__meta-item">

                        <span class="offer-detail__meta-label">
                            Отель
                        </span>

                        <div class="offer-detail__meta-value">
                            Лермонт
                        </div>

                    </div>

                </div>

            </div>


            <aside class="offer-detail__aside">

                <div class="offer-detail__box">

                    <span class="offer-detail__box-label">
                        Забронировать
                    </span>

                    <h2 class="offer-detail__box-title">
                        Воспользуйтесь специальным предложением
                    </h2>

                    <div class="offer-detail__box-text">
                        Для бронирования выберите даты проживания
                        и подходящий номер.
                    </div>

                    <a
                        href="{{ $buttonUrl }}"
                        class="offer-detail__button"
                    >
                        <span>{{ $buttonText }}</span>

                        <span class="offer-detail__button-arrow">
                            →
                        </span>
                    </a>

                </div>

            </aside>

        </div>

    </div>

</article>

@endsection