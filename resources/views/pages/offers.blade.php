@extends('layouts.app')

@section('title', 'Акции и специальные предложения')

@section('content')

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
