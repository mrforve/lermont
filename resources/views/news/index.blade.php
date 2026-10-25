@extends('layouts.app')

@section('title', 'Новости')

@section('content')

<section class="news-page">

    <div class="container">

        <div class="news-page__head">

            <div>

                <span class="news-page__eyebrow">
                    Лермонт
                </span>

                <h1>
                    Новости
                </h1>

            </div>

        </div>


        @if ($newsItems->isNotEmpty())

            <div class="news-grid">

                @foreach ($newsItems as $news)

                    <a
                        href="{{ route('news.show', $news) }}"
                        class="news-card"
                    >

                        <div class="news-card__image">

                            @if ($news->image)

                                <img
                                    src="{{ asset('storage/' . $news->image) }}"
                                    alt="{{ $news->title }}"
                                    loading="lazy"
                                >

                            @endif

                        </div>


                        @if ($news->published_at)

                            <span class="news-card__date">
                                {{ $news->published_at->translatedFormat('d F Y') }}
                            </span>

                        @endif


                        <h2>
                            {{ $news->title }}
                        </h2>


                        @if ($news->short_description)

                            <div class="news-card__description">
                                {{ $news->short_description }}
                            </div>

                        @endif


                        <span class="news-card__more">
                            Подробнее
                            <span>→</span>
                        </span>

                    </a>

                @endforeach

            </div>


            @if ($newsItems->hasPages())

                <div class="news-pagination">
                    {{ $newsItems->links() }}
                </div>

            @endif

        @else

            <p class="news-empty">
                Новости пока не опубликованы.
            </p>

        @endif

    </div>

</section>

@endsection