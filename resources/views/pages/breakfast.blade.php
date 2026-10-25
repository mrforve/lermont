@extends('layouts.app')

@section('title', 'Завтраки')

@section('content')

<style>
.breakfast-page {
    background: var(--cream);
    color: var(--text);
}


/* HERO */

.breakfast-hero {
    position: relative;
    min-height: 720px;
    overflow: hidden;
}

.breakfast-hero__image {
    position: absolute;
    inset: 0 0 0 35%;
}

.breakfast-hero__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.breakfast-hero__image::after {
    content: "";
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            var(--cream) 0%,
            rgba(245,239,230,.75) 14%,
            transparent 48%
        );
}

.breakfast-hero__content {
    position: relative;
    z-index: 2;

    display: flex;
    flex-direction: column;
    justify-content: center;

    width: 48%;
    min-height: 720px;

    padding: 100px 0 80px;
}

.breakfast-hero__eyebrow {
    margin-bottom: 18px;

    color: var(--gold-dark);

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .14em;

    text-transform: uppercase;
}

.breakfast-hero h1 {
    margin: 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: clamp(58px, 5vw, 82px);
    font-weight: 500;
    line-height: .92;
    letter-spacing: -.04em;
}

.breakfast-hero__lead {
    max-width: 460px;

    margin: 28px 0 34px;

    font-size: 20px;
    line-height: 1.55;
}

.breakfast-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 14px;

    width: fit-content;

    min-height: 58px;

    padding: 0 21px;

    border: 1px solid var(--line);

    color: var(--gold-dark);

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .05em;

    text-transform: uppercase;
}

.breakfast-hero__badge svg {
    width: 25px;
    height: 25px;

    fill: none;
    stroke: currentColor;
    stroke-width: 1.4;
}


/* INTRO */

.breakfast-intro {
    padding: 22px 0;

    border-top: 1px solid var(--line);
    border-bottom: 1px solid var(--line);

    text-align: center;

    font-family: var(--serif);
    font-size: 24px;

    color: var(--green);
}


/* VIDEO */

.breakfast-video {
    padding: 78px 0;
}

.breakfast-video__frame {
    position: relative;

    height: 570px;

    overflow: hidden;

    background: var(--green-deep);
}

.breakfast-video__frame video {
    width: 100%;
    height: 100%;

    object-fit: cover;
}

.breakfast-video__frame::after {
    content: "";

    position: absolute;
    inset: 0;

    pointer-events: none;

    background:
        linear-gradient(
            180deg,
            transparent 50%,
            rgba(24,40,32,.38) 100%
        );
}

.breakfast-video__play {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 3;

    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 13px;

    transform: translate(-50%, -50%);

    border: 0;
    background: transparent;

    color: #fff;

    font-size: 14px;
    font-weight: 700;

    cursor: pointer;
}

.breakfast-video__circle {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 76px;
    height: 76px;

    border: 2px solid rgba(255,255,255,.9);
    border-radius: 50%;

    background: rgba(24,40,32,.18);

    backdrop-filter: blur(4px);

    transition:
        transform .2s ease,
        background-color .2s ease;
}

.breakfast-video__circle svg {
    width: 27px;
    height: 27px;

    fill: #fff;
}

.breakfast-video__play:hover .breakfast-video__circle {
    transform: scale(1.07);

    background: var(--gold);
}


/* DETAILS */

.breakfast-details {
    padding: 12px 0 90px;
}

.breakfast-section-title {
    margin: 0 0 32px;

    color: var(--green);

    font-family: var(--serif);
    font-size: 52px;
    font-weight: 500;
    line-height: 1;
}

.breakfast-details__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);

    gap: 18px;
}

.breakfast-detail-card__image {
    height: 300px;

    overflow: hidden;
}

.breakfast-detail-card__image img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform .45s ease;
}

.breakfast-detail-card:hover img {
    transform: scale(1.025);
}

.breakfast-detail-card h3 {
    margin: 17px 0 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: 28px;
    font-weight: 500;
}


/* BUFFET */

.breakfast-buffet {
    padding: 80px 0;

    background: #f0e9df;
}

.breakfast-buffet__grid {
    display: grid;
    grid-template-columns: .72fr 1.6fr;

    gap: 55px;
    align-items: center;
}

.breakfast-buffet h2 {
    margin: 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: 52px;
    font-weight: 500;
    line-height: .98;
}

.breakfast-buffet p {
    margin: 22px 0 0;

    max-width: 350px;

    color: var(--muted);

    font-size: 15px;
    line-height: 1.7;
}

.breakfast-buffet__image {
    height: 430px;

    overflow: hidden;
}

.breakfast-buffet__image img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}


/* SPECIAL */

.breakfast-special {
    padding: 80px 0 86px;

    background: var(--green-deep);

    color: #fff;
}

.breakfast-special__head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 30px;

    margin-bottom: 30px;
}

.breakfast-special h2 {
    margin: 0;

    color: #fff;

    font-family: var(--serif);
    font-size: 52px;
    font-weight: 500;
}

.breakfast-special__note {
    color: var(--gold);

    font-size: 10px;
    font-weight: 700;
    letter-spacing: .17em;

    text-transform: uppercase;
}

.breakfast-special__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;

    gap: 18px;
}

.breakfast-special__card {
    position: relative;

    min-height: 310px;

    border: 1px solid rgba(255,255,255,.1);

    overflow: hidden;
}

.breakfast-special__card img {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    object-fit: cover;

    opacity: .28;
}

.breakfast-special__card::after {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            180deg,
            rgba(24,40,32,.1),
            rgba(24,40,32,.75)
        );
}

.breakfast-special__content {
    position: relative;
    z-index: 2;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    min-height: 310px;

    text-align: center;
}

.breakfast-special__play {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 62px;
    height: 62px;

    margin-bottom: 16px;

    border: 1px solid var(--gold);
    border-radius: 50%;

    color: var(--gold);
}

.breakfast-special__play svg {
    width: 23px;
    height: 23px;

    fill: currentColor;
}

.breakfast-special__content h3 {
    margin: 0;

    font-family: var(--serif);
    font-size: 30px;
    font-weight: 500;
}

.breakfast-special__content span {
    margin-top: 6px;

    color: rgba(255,255,255,.7);

    font-size: 11px;
}


/* EARLY */

.breakfast-early {
    padding: 75px 0;

    background: var(--cream);
}

.breakfast-early__grid {
    display: grid;
    grid-template-columns: .7fr 1.3fr;

    gap: 70px;

    align-items: start;
}

.breakfast-early h2 {
    margin: 0;

    color: var(--green);

    font-family: var(--serif);
    font-size: 44px;
    font-weight: 500;
}

.breakfast-early p {
    margin: 0;

    font-size: 15px;
    line-height: 1.75;
}


/* CTA */

.breakfast-cta {
    padding: 75px 0 90px;

    text-align: center;

    border-top: 1px solid var(--line);
}

.breakfast-cta h2 {
    margin: 0 0 28px;

    color: var(--green);

    font-family: var(--serif);
    font-size: 52px;
    font-weight: 500;
}

.breakfast-cta__buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.breakfast-cta__secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 52px;

    padding: 0 30px;

    border: 1px solid var(--line);

    color: var(--green);

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;
}


/* MOBILE */

@media (max-width: 991px) {

    .breakfast-hero {
        min-height: 650px;
    }

    .breakfast-hero__image {
        inset: 0;
    }

    .breakfast-hero__image::after {
        background:
            linear-gradient(
                90deg,
                rgba(245,239,230,.96) 0%,
                rgba(245,239,230,.83) 50%,
                rgba(245,239,230,.22) 100%
            );
    }

    .breakfast-hero__content {
        width: 70%;
        min-height: 650px;
    }

    .breakfast-details__grid {
        grid-template-columns: 1fr 1fr;
    }

    .breakfast-detail-card:last-child {
        grid-column: span 2;
    }

    .breakfast-buffet__grid {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 767px) {

    .breakfast-hero {
        min-height: 620px;
    }

    .breakfast-hero__content {
        width: 100%;
        min-height: 620px;

        padding-top: 110px;
    }

    .breakfast-hero h1 {
        font-size: 52px;
    }

    .breakfast-video {
        padding: 45px 0;
    }

    .breakfast-video__frame {
        height: 360px;
    }

    .breakfast-details {
        padding-bottom: 55px;
    }

    .breakfast-section-title,
    .breakfast-buffet h2,
    .breakfast-special h2,
    .breakfast-cta h2 {
        font-size: 39px;
    }

    .breakfast-details__grid,
    .breakfast-special__grid,
    .breakfast-early__grid {
        grid-template-columns: 1fr;
    }

    .breakfast-detail-card:last-child {
        grid-column: auto;
    }

    .breakfast-detail-card__image {
        height: 250px;
    }

    .breakfast-buffet__image {
        height: 310px;
    }

    .breakfast-special__head {
        display: block;
    }

    .breakfast-special__note {
        display: block;

        margin-top: 12px;
    }

    .breakfast-early__grid {
        gap: 22px;
    }

    .breakfast-cta__buttons {
        flex-direction: column;
    }

}
</style>


<div class="breakfast-page">


    <section class="breakfast-hero">

        <div class="breakfast-hero__image">
            <img
                src="{{ asset('img/KIR_4324.jpg') }}"
                alt="Завтрак в отеле Лермонт"
            >
        </div>

        <div class="container">

            <div class="breakfast-hero__content">

                <span class="breakfast-hero__eyebrow">
                    Доброе утро в «Лермонте»
                </span>

                <h1>
                    Утро<br>
                    в «Лермонте»
                </h1>

                <p class="breakfast-hero__lead">
                    Шведский стол и время для себя
                </p>

                <div class="breakfast-hero__badge">

                    <svg viewBox="0 0 32 32">
                        <path d="M8 10h13v7c0 4-3 7-7 7s-6-3-6-7v-7Z"/>
                        <path d="M21 12h2c3 0 5 2 5 5s-2 5-5 5h-3"/>
                        <path d="M6 27h19"/>
                    </svg>

                    Завтрак включён в проживание

                </div>

            </div>

        </div>

    </section>


    <div class="breakfast-intro">
        <div class="container">
            Выбирайте любимое и пробуйте новое:
            блюда меняются по дням недели.
        </div>
    </div>


    <section class="breakfast-video">

        <div class="container">

            <div class="breakfast-video__frame">

                <video
                    src="{{ asset('img/breakfast.mp4') }}"
                    poster="{{ asset('img/KIR_4350.jpg') }}"
                    playsinline
                    preload="metadata"
                    data-breakfast-page-video
                ></video>

                <button
                    type="button"
                    class="breakfast-video__play"
                    data-breakfast-page-play
                >
                    <span class="breakfast-video__circle">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 7l8 5-8 5V7Z"/>
                        </svg>
                    </span>

                    Посмотреть завтрак
                </button>

            </div>

        </div>

    </section>


    <section class="breakfast-details">

        <div class="container">

            <h2 class="breakfast-section-title">
                Завтрак в деталях
            </h2>

            <div class="breakfast-details__grid">

                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ asset('img/KIR_4350.jpg') }}"
                            alt="Уютная атмосфера"
                            loading="lazy"
                        >
                    </div>

                    <h3>Уютная атмосфера</h3>

                </article>


                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ asset('img/KIR_4324.jpg') }}"
                            alt="Горячие блюда и блинчики"
                            loading="lazy"
                        >
                    </div>

                    <h3>Горячие блюда и блинчики</h3>

                </article>


                <article class="breakfast-detail-card">

                    <div class="breakfast-detail-card__image">
                        <img
                            src="{{ asset('img/KIR_4350.jpg') }}"
                            alt="Кофе, чай и выпечка"
                            loading="lazy"
                        >
                    </div>

                    <h3>Кофе, чай и выпечка</h3>

                </article>

            </div>

        </div>

    </section>


    <section class="breakfast-buffet">

        <div class="container">

            <div class="breakfast-buffet__grid">

                <div>

                    <h2>
                        Место для<br>
                        неспешного утра
                    </h2>

                    <p>
                        Светлый зал, уютные столики
                        и приятное начало дня.
                    </p>

                </div>

                <div class="breakfast-buffet__image">
                    <img
                        src="{{ asset('img/KIR_4324.jpg') }}"
                        alt="Шведский стол в отеле Лермонт"
                        loading="lazy"
                    >
                </div>

            </div>

        </div>

    </section>


    <section class="breakfast-special">

        <div class="container">

            <div class="breakfast-special__head">

                <h2>
                    Особенные утра
                </h2>

                <span class="breakfast-special__note">
                    Праздники тоже вкуснее в «Лермонте»
                </span>

            </div>


            <div class="breakfast-special__grid">

                <div class="breakfast-special__card">

                    <img
                        src="{{ asset('img/KIR_4350.jpg') }}"
                        alt=""
                    >

                    <div class="breakfast-special__content">

                        <span class="breakfast-special__play">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 7l8 5-8 5V7Z"/>
                            </svg>
                        </span>

                        <h3>Новогодний завтрак</h3>

                        <span>Здесь будет ваше видео</span>

                    </div>

                </div>


                <div class="breakfast-special__card">

                    <img
                        src="{{ asset('img/KIR_4324.jpg') }}"
                        alt=""
                    >

                    <div class="breakfast-special__content">

                        <span class="breakfast-special__play">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 7l8 5-8 5V7Z"/>
                            </svg>
                        </span>

                        <h3>Праздничные фуршеты</h3>

                        <span>Здесь будет ваше видео</span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section class="breakfast-early">

        <div class="container">

            <div class="breakfast-early__grid">

                <h2>
                    Уезжаете рано?
                </h2>

                <p>
                    Подготовим для вас ланч-бокс с лёгким перекусом:
                    круассаном или печеньем, яблоком и напитком.
                    А для бодрого начала дня предложим кофе с собой.
                    <br><br>
                    Пожалуйста, сообщите администратору о раннем
                    выезде накануне.
                </p>

            </div>

        </div>

    </section>


    <section class="breakfast-cta">

        <div class="container">

            <h2>
                Начните отдых с приятного утра
            </h2>

            <div class="breakfast-cta__buttons">

                <a
                    href="{{ route('rooms.index') }}"
                    class="btn btn-gold px-5 py-3"
                >
                    Выбрать номер →
                </a>

                <a
                    href="{{ url('/contacts') }}"
                    class="breakfast-cta__secondary"
                >
                    Задать вопрос
                </a>

            </div>

        </div>

    </section>

</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const video =
        document.querySelector('[data-breakfast-page-video]');

    const play =
        document.querySelector('[data-breakfast-page-play]');


    if (!video || !play) {
        return;
    }


    play.addEventListener('click', () => {

        video.controls = true;

        video.play();

        play.style.display = 'none';

    });


    video.addEventListener('ended', () => {

        video.controls = false;

        play.style.display = '';

    });

});
</script>

@endsection