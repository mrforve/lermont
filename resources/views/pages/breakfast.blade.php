@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@section('content')

<div class="breakfast-page">


    @if(\App\Support\PageContent::visible($page, 'breakfast-hero'))
<section class="breakfast-hero">

        <div class="breakfast-hero__image">
            <img
                src="{{ \App\Support\PageContent::media($page, 'breakfast_hero_image_1', 1000) }}"
                alt="{{ \App\Support\PageContent::text($page, 'breakfast_hero_alt_1') }}"
            >
        </div>

        <div class="container">

            <div class="breakfast-hero__content">

                <span class="breakfast-hero__eyebrow">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_hero_text_1'))) !!}
                </span>

                <h1>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_hero_text_2'))) !!}<br>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_hero_text_3'))) !!}
                </h1>

                <p class="breakfast-hero__lead">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_hero_text_4'))) !!}
                </p>

                <div class="breakfast-hero__badge">

                    <svg viewBox="0 0 32 32">
                        <path d="M8 10h13v7c0 4-3 7-7 7s-6-3-6-7v-7Z"/>
                        <path d="M21 12h2c3 0 5 2 5 5s-2 5-5 5h-3"/>
                        <path d="M6 27h19"/>
                    </svg>

                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_hero_text_5'))) !!}

                </div>

            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-intro'))
    <div class="breakfast-intro">
        <div class="container">
            {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_intro_text_1'))) !!}
        </div>
    </div>
    @endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-video'))
<section class="breakfast-video">

        <div class="container">

            <div class="breakfast-video__frame">

                <video
                    data-preview-video-src="{{ \App\Support\PageContent::media($page, 'breakfast_video_video_2') }}"
                    poster="{{ \App\Support\PageContent::media($page, 'breakfast_video_image_3', 1000) }}"
                    playsinline
                    preload="none"
                    data-breakfast-page-video
                ></video>

                <a
                    href="{{ \App\Support\PageContent::media($page, 'breakfast_video_video_2') }}"
                    class="breakfast-video__play"
                    data-breakfast-page-play
                    data-page-video-open="{{ \App\Support\PageContent::media($page, 'breakfast_video_video_2') }}"
                    aria-haspopup="dialog"
                    aria-controls="breakfast-video-dialog"
                >
                    <span class="breakfast-video__circle">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 7l8 5-8 5V7Z"/>
                        </svg>
                    </span>

                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_video_text_1'))) !!}
                </a>

            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-details'))
<section class="breakfast-details">

        <div class="container">

            <h2 class="breakfast-section-title">
                {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_details_text_1'))) !!}
            </h2>

            <div class="breakfast-details__grid">

                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ \App\Support\PageContent::media($page, 'breakfast_details_image_4', 1000) }}"
                            alt="{{ \App\Support\PageContent::text($page, 'breakfast_details_alt_2') }}"
                            loading="lazy"
                        >
                    </div>

                    <h3>{!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_details_text_2'))) !!}</h3>

                </article>


                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ \App\Support\PageContent::media($page, 'breakfast_details_image_5', 1000) }}"
                            alt="{{ \App\Support\PageContent::text($page, 'breakfast_details_alt_3') }}"
                            loading="lazy"
                        >
                    </div>

                    <h3>{!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_details_text_3'))) !!}</h3>

                </article>


                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ \App\Support\PageContent::media($page, 'breakfast_details_image_6', 1000) }}"
                            alt="{{ \App\Support\PageContent::text($page, 'breakfast_details_alt_4') }}"
                            loading="lazy"
                        >
                    </div>

                    <h3>{!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_details_text_4'))) !!}</h3>

                </article>

            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-buffet'))
<section class="breakfast-buffet">

        <div class="container">

            <div class="breakfast-buffet__grid">

                <div>

                    <h2>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_buffet_text_1'))) !!}<br>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_buffet_text_2'))) !!}
                    </h2>

                    <p>
                        {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_buffet_text_3'))) !!}
                    </p>

                </div>

                <div class="breakfast-buffet__image">
                    <img
                        src="{{ \App\Support\PageContent::media($page, 'breakfast_buffet_image_7', 1000) }}"
                        alt="{{ \App\Support\PageContent::text($page, 'breakfast_buffet_alt_5') }}"
                        loading="lazy"
                    >
                </div>

            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-special'))
<section class="breakfast-special">

        <div class="container">

            <div class="breakfast-special__head">

                <h2>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_special_text_1'))) !!}
                </h2>

                <span class="breakfast-special__note">
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_special_text_2'))) !!}
                </span>

            </div>


            <div class="breakfast-special__grid">

                <a class="breakfast-special__card" href="{{ \App\Support\PageContent::media($page, 'breakfast_special_video_1') }}" data-page-video-open="{{ \App\Support\PageContent::media($page, 'breakfast_special_video_1') }}" aria-haspopup="dialog" aria-controls="breakfast-video-dialog">

                    <img
                        src="{{ \App\Support\PageContent::media($page, 'breakfast_special_image_8', 1000) }}"
                        alt="{{ \App\Support\PageContent::text($page, 'breakfast_special_alt_6') }}"
                    >

                    <div class="breakfast-special__content">

                        <span class="breakfast-special__play">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 7l8 5-8 5V7Z"/>
                            </svg>
                        </span>

                        <h3>{!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_special_text_3'))) !!}</h3>

                        <span>{!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_special_text_4'))) !!}</span>

                    </div>

                </a>




            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-early'))
<section class="breakfast-early">

        <div class="container">

            <div class="breakfast-early__grid">

                <h2>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_early_text_1'))) !!}
                </h2>

                <p>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_early_text_2'))) !!}
                    <br><br>
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_early_text_3'))) !!}
                </p>

            </div>

        </div>

    </section>
@endif


    @if(\App\Support\PageContent::visible($page, 'breakfast-cta'))
<section class="breakfast-cta">

        <div class="container">

            <h2>
                {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_cta_text_1'))) !!}
            </h2>

            <div class="breakfast-cta__buttons">

                <a
                    href="{{ \App\Support\PageContent::link($page, 'breakfast_cta_link_1') }}"
                    class="btn btn-gold px-5 py-3"
                >
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_cta_text_2'))) !!}
                </a>

                <a
                    href="{{ \App\Support\PageContent::link($page, 'breakfast_cta_contact_link') }}"
                    class="breakfast-cta__secondary"
                >
                    {!! nl2br(e(\App\Support\PageContent::text($page, 'breakfast_cta_text_3'))) !!}
                </a>

            </div>

        </div>

    </section>
@endif

</div>


<dialog class="video-lightbox" id="breakfast-video-dialog" data-page-video-dialog aria-label="Видео завтраков в отеле Лермонт">
    <button type="button" class="video-lightbox__close" data-page-video-close aria-label="Закрыть видео" autofocus>×</button>
    <div class="video-lightbox__content"><video controls playsinline preload="none" data-page-video-player></video></div>
</dialog>


@endsection
