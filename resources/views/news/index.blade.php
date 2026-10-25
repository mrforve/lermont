@extends('layouts.app')

@section('title', 'Новости')

@section('content')

<style>
.news-page {
    padding: 125px 0 100px;
    background: var(--cream);
}

.news-page__head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 30px;

    margin-bottom: 48px;
}

.news-page__eyebrow {
    display: block;

    margin-bottom: 10px;

    color: var(--gold-dark);

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .13em;

    text-transform: uppercase;
}

.news-page h1 {
    margin: 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: clamp(54px, 5vw, 78px);
    font-weight: 500;
    line-height: .92;
    letter-spacing: -.03em;

    text-transform: uppercase;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));

    gap: 34px 22px;
}

.news-card {
    display: block;

    color: inherit;

    text-decoration: none;
}

.news-card__image {
    position: relative;

    aspect-ratio: 1.45 / 1;

    overflow: hidden;

    background: var(--cream-2);
}

.news-card__image img {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform .45s ease;
}

.news-card:hover .news-card__image img {
    transform: scale(1.035);
}

.news-card__date {
    display: inline-block;

    margin-top: 18px;

    color: var(--gold-dark);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;

    text-transform: uppercase;
}

.news-card h2 {
    margin: 8px 0 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: 29px;
    font-weight: 500;
    line-height: 1.05;
}

.news-card__description {
    margin-top: 12px;

    color: var(--muted);

    font-size: 13px;
    line-height: 1.6;
}

.news-card__more {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    margin-top: 17px;

    color: var(--gold-dark);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;

    text-transform: uppercase;
}

.news-card__more span {
    font-size: 17px;

    transition: transform .2s ease;
}

.news-card:hover .news-card__more span {
    transform: translateX(4px);
}

.news-empty {
    color: var(--muted);

    font-size: 14px;
}

.news-pagination {
    margin-top: 50px;
}

@media (max-width: 991px) {
    .news-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767px) {
    .news-page {
        padding: 90px 0 60px;
    }

    .news-page__head {
        margin-bottom: 30px;
    }

    .news-page h1 {
        font-size: 44px;
    }

    .news-grid {
        grid-template-columns: 1fr;

        gap: 32px;
    }
}
</style>


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