@extends('layouts.app')

@section(
    'title',
    $news->seo_title ?: $news->title
)

@section('content')

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