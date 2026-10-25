@extends('layouts.app')

@section(
    'title',
    $news->seo_title ?: $news->title
)

@section('content')

<style>
.news-detail {
    padding: 125px 0 100px;
    background: var(--cream);
}

.news-detail__inner {
    max-width: 980px;
    margin: 0 auto;
}

.news-detail__back {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 34px;

    color: var(--gold-dark);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;

    text-decoration: none;
    text-transform: uppercase;
}

.news-detail__back span {
    font-size: 17px;
}

.news-detail__date {
    display: block;

    margin-bottom: 13px;

    color: var(--gold-dark);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .09em;

    text-transform: uppercase;
}

.news-detail h1 {
    max-width: 900px;

    margin: 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: clamp(48px, 5vw, 72px);
    font-weight: 500;
    line-height: .95;
    letter-spacing: -.03em;
}

.news-detail__lead {
    max-width: 760px;

    margin: 24px 0 0;

    color: var(--muted);

    font-size: 17px;
    line-height: 1.65;
}

.news-detail__image {
    margin: 42px 0;

    aspect-ratio: 1.75 / 1;

    overflow: hidden;

    background: var(--cream-2);
}

.news-detail__image img {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;
}

.news-detail__content {
    max-width: 780px;

    color: var(--text);

    font-size: 15px;
    line-height: 1.8;
}

.news-detail__content p {
    margin: 0 0 22px;
}

.news-detail__content h2,
.news-detail__content h3 {
    margin: 38px 0 18px;

    color: var(--green);

    font-family: var(--serif);
    font-weight: 500;
}

.news-detail__content h2 {
    font-size: 38px;
}

.news-detail__content h3 {
    font-size: 30px;
}

.news-detail__content img {
    max-width: 100%;
    height: auto;
}

.news-detail__content a {
    color: var(--gold-dark);
}

@media (max-width: 767px) {
    .news-detail {
        padding: 90px 0 60px;
    }

    .news-detail h1 {
        font-size: 44px;
    }

    .news-detail__image {
        margin: 30px 0;

        aspect-ratio: 1.3 / 1;
    }

    .news-detail__lead {
        font-size: 15px;
    }
}
</style>


<article class="news-detail">

    <div class="container">

        <div class="news-detail__inner">

            <a
                href="{{ route('news.index') }}"
                class="news-detail__back"
            >
                <span>←</span>
                Все новости
            </a>


            @if ($news->published_at)

                <time
                    class="news-detail__date"
                    datetime="{{ $news->published_at->toDateString() }}"
                >
                    {{ $news->published_at->translatedFormat('d F Y') }}
                </time>

            @endif


            <h1>
                {{ $news->title }}
            </h1>


            @if ($news->short_description)

                <div class="news-detail__lead">
                    {{ $news->short_description }}
                </div>

            @endif


            @if ($news->image)

                <div class="news-detail__image">

                    <img
                        src="{{ asset('storage/' . $news->image) }}"
                        alt="{{ $news->title }}"
                    >

                </div>

            @endif


            @if ($news->content)

                <div class="news-detail__content">
                    {!! $news->content !!}
                </div>

            @endif

        </div>

    </div>

</article>

@endsection