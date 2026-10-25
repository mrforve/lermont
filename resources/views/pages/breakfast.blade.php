@extends('layouts.app')

@section('title', 'Завтраки')

@section('content')

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