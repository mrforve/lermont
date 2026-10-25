@extends('layouts.app')

@section('title', 'Акции и специальные предложения')

@section('content')

<style>
    .offers-page {
        padding: 145px 0 100px;
        background: var(--cream);
    }

    .offers-page__intro {
        max-width: 900px;
        margin: 0 auto 52px;
        text-align: center;
    }

    .offers-page__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 15px;
        color: var(--gold);
        font-family: var(--sans);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .offers-page__eyebrow::before,
    .offers-page__eyebrow::after {
        content: "";
        width: 34px;
        height: 1px;
        background: var(--gold);
    }

    .offers-page__title {
        margin: 0 0 18px;
        color: var(--green);
        font-family: var(--serif);
        font-size: clamp(52px, 4.7vw, 76px);
        font-weight: 500;
        line-height: .94;
        letter-spacing: -.025em;
    }

    .offers-page__lead {
        max-width: 650px;
        margin: 0 auto;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.7;
    }

    .offers-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .offers-card-link {
        display: block;
        height: 100%;
        color: inherit;
        text-decoration: none;
    }

    .offers-card {
        height: 100%;
        overflow: hidden;
        background: var(--green);
        box-shadow: 0 14px 36px rgba(24, 40, 32, .10);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .offers-card-link:hover .offers-card {
        transform: translateY(-5px);
        box-shadow: 0 22px 48px rgba(24, 40, 32, .18);
    }

    .offers-card__image {
        aspect-ratio: 1.42 / 1;
        overflow: hidden;
        background: var(--cream-2);
    }

    .offers-card__image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .65s ease;
    }

    .offers-card-link:hover .offers-card__image img {
        transform: scale(1.035);
    }

    .offers-card__body {
        background: var(--green);
    }

    .offers-card__title {
        min-height: 100px;
        padding: 23px 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .11);
        color: #fff;
        font-family: var(--serif);
        font-size: 29px;
        font-weight: 500;
        line-height: 1;
    }

    .offers-card__bottom {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 58px;
        min-height: 108px;
    }

    .offers-card__excerpt {
        display: flex;
        align-items: flex-end;
        padding: 20px 24px;
        color: rgba(255, 255, 255, .74);
        font-family: var(--sans);
        font-size: 12px;
        line-height: 1.55;
    }

    .offers-card__arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        border-left: 1px solid rgba(255, 255, 255, .11);
        color: var(--gold);
        font-size: 22px;
    }

    @media (max-width: 1440px) {
        .offers-page {
            padding: 110px 0 72px;
        }

        .offers-page__intro {
            margin-bottom: 38px;
        }

        .offers-page__title {
            font-size: 56px;
        }

        .offers-grid {
            gap: 16px;
        }

        .offers-card__title {
            min-height: 82px;
            padding: 17px 18px 15px;
            font-size: 23px;
        }

        .offers-card__bottom {
            grid-template-columns: minmax(0, 1fr) 50px;
            min-height: 88px;
        }

        .offers-card__excerpt {
            padding: 15px 18px;
            font-size: 11px;
        }
    }

    @media (max-width: 1199px) {
        .offers-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {
        .offers-page {
            padding: 92px 0 52px;
        }

        .offers-page__intro {
            text-align: left;
        }

        .offers-page__eyebrow::after {
            display: none;
        }

        .offers-page__title {
            font-size: 43px;
        }

        .offers-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="offers-page">
    <div class="container">

        <header class="offers-page__intro">
            <span class="offers-page__eyebrow">Специально для вас</span>

            <h1 class="offers-page__title">
                Акции и специальные предложения
            </h1>

            <p class="offers-page__lead">
                Выгодные условия проживания, подарки и специальные тарифы
                для гостей отеля «Лермонт».
            </p>
        </header>

        <div class="offers-grid">

            @forelse ($promotions as $promotion)

                @php
                    $imageUrl = $promotion->image
                        ? asset('storage/' . $promotion->image)
                        : $promotion->legacy_image_url;

                    $excerpt = \Illuminate\Support\Str::of(
                        strip_tags($promotion->content ?? '')
                    )
                        ->replace('&nbsp;', ' ')
                        ->squish()
                        ->limit(72);
                @endphp

                <a
                    href="{{ route('offers.show', ['slug' => $promotion->slug]) }}"
                    class="offers-card-link"
                >
                    <article class="offers-card">

                        @if ($imageUrl)
                            <div class="offers-card__image">
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $promotion->title }}"
                                >
                            </div>
                        @endif

                        <div class="offers-card__body">

                            <div class="offers-card__title">
                                {{ $promotion->title }}
                            </div>

                            <div class="offers-card__bottom">

                                <div class="offers-card__excerpt">
                                    {{ $excerpt ?: 'Подробнее о специальном предложении' }}
                                </div>

                                <div class="offers-card__arrow">
                                    ↗
                                </div>

                            </div>

                        </div>

                    </article>
                </a>

            @empty

                <p>Активных акций сейчас нет.</p>

            @endforelse

        </div>
    </div>
</section>

@endsection
