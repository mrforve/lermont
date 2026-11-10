@extends('layouts.app')

@section('title', $promotion->seo_title ?: $promotion->title)
@section('description', $promotion->seo_description ?: \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($promotion->content ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'))), 160))

@section('content')

@php
    $imageUrl = $promotion->image
        ? asset('storage/' . $promotion->image)
        : $promotion->legacy_image_url;

    $buttonText = $promotion->button_text ?: 'Написать в MAX';
    $buttonUrl = $promotion->button_url ?: 'https://max.ru/u/f9LHodD0cOK4G43DwSuPA5VIJa5VpTvBReELJPM9XQC3q5I1UzjmGjBXVVA';
@endphp

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
                        src="{{ \App\Support\ResponsiveImage::url($imageUrl, 1000) }}"
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
                        Уточните наличие номеров на ваши даты и напишите/позвоните нам для брони
                    </div>

                    <a
                        href="{{ $buttonUrl }}"
                        class="offer-detail__button"
                        target="_blank"
                        rel="noopener noreferrer"
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