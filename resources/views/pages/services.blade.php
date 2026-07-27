@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@section('content')
@php
    $imageUrl = function (int $index, string $fallback) use ($galleryImages): string {
        $image = $galleryImages->get($index);
        return $image?->image ? asset('storage/' . $image->image) : $fallback;
    };
@endphp

<section class="services-hero">
    <div class="container services-hero__content">
        <div class="page-eyebrow"><span></span> ЛЕРМОНТ</div>
        <h1>{{ $page->title ?: 'Услуги' }}</h1>
        <p>Всё необходимое для комфортного отдыха, семейной поездки и делового визита в Геленджик.</p>
    </div>
</section>

<section class="services-intro page-section">
    <div class="container">
        <div class="services-heading">
            <div class="page-eyebrow page-eyebrow--dark"><span></span> ЗАБОТА О ГОСТЯХ</div>
            <h2>Продумано до мелочей</h2>
            <p>Часть услуг уже включена в проживание. Дополнительные возможности можно заказать у администратора.</p>
        </div>

        <div class="services-benefits">
            <article><span>01</span><h3>Завтраки</h3><p>Комплиментарный завтрак в формате «шведский стол».</p></article>
            <article><span>02</span><h3>Парковка</h3><p>Парковка напротив отеля при прямом бронировании.</p></article>
            <article><span>03</span><h3>Wi‑Fi</h3><p>Скоростной интернет на всей территории отеля.</p></article>
            <article><span>04</span><h3>Для семьи</h3><p>Детские принадлежности, книги и настольные игры.</p></article>
        </div>
    </div>
</section>

<section class="services-feature services-feature--light">
    <div class="container services-feature__grid">
        <div class="services-feature__copy">
            <div class="page-eyebrow page-eyebrow--dark"><span></span> БИЗНЕС</div>
            <h2>Групповые и корпоративные заезды</h2>
            <p>Мы работаем с бизнес-сегментом и открыты для групповых заездов. Отель расположен в центре курорта, рядом с городской инфраструктурой и площадками для мероприятий.</p>
            <ul class="services-checklist">
                <li>индивидуальные условия размещения;</li>
                <li>собственная парковка напротив отеля;</li>
                <li>скоростной Wi‑Fi для рабочих задач;</li>
                <li>подготовка персонального предложения.</li>
            </ul>
            <a class="about-outline-btn" href="mailto:info@hotel-lermont.ru">Запросить предложение</a>
        </div>
        <div class="services-feature__media"><img src="{{ $imageUrl(0, 'https://hotel-lermont.ru/wp-content/uploads/2022/05/mice_001.jpg') }}" alt="Корпоративное размещение в отеле Лермонт"></div>
    </div>
</section>

<section class="services-feature services-feature--reverse">
    <div class="container services-feature__grid">
        <div class="services-feature__media"><img src="{{ $imageUrl(1, 'https://hotel-lermont.ru/wp-content/uploads/2022/09/20220928_145356-855x1024.jpg') }}" alt="Комплиментарные услуги отеля"></div>
        <div class="services-feature__copy">
            <div class="page-eyebrow page-eyebrow--dark"><span></span> ВКЛЮЧЕНО</div>
            <h2>Комплиментарные услуги</h2>
            <ul class="services-checklist services-checklist--columns">
                <li>завтрак «шведский стол»;</li>
                <li>Smart TV и Wi‑Fi;</li>
                <li>косметические принадлежности;</li>
                <li>чайная станция и вода;</li>
                <li>спортинвентарь;</li>
                <li>зонты на случай непогоды;</li>
                <li>книги и журналы;</li>
                <li>пляжные полотенца с сумкой под депозит.</li>
            </ul>
        </div>
    </div>
</section>

<section class="services-family page-section">
    <div class="container">
        <div class="services-heading services-heading--center">
            <div class="page-eyebrow page-eyebrow--dark"><span></span> ДЛЯ ДЕТЕЙ</div>
            <h2>Для самых важных гостей</h2>
            <p>Детские принадлежности предоставляются при наличии на дату заезда.</p>
        </div>
        <div class="services-family__grid">
            <article><h3>Детские кроватки</h3><p>Предоставляются по факту прибытия при наличии.</p></article>
            <article><h3>Горшки и насадки</h3><p>Доступны по запросу при наличии.</p></article>
            <article><h3>Ступеньки для ванной</h3><p>Для удобства маленьких гостей.</p></article>
            <article><h3>Книги и игры</h3><p>Бесплатно в общей зоне отеля.</p></article>
            <article><h3>Детский стульчик</h3><p>В зале завтраков, количество ограничено.</p></article>
        </div>
    </div>
</section>

<section class="services-extra">
    <div class="container services-extra__grid">
        <article>
            <div class="page-eyebrow page-eyebrow--dark"><span></span> РАННИЙ ВЫЕЗД</div>
            <h2>Ранний завтрак</h2>
            <p>При выезде до начала завтрака предложим кофе или чай и подготовим ланч-бокс: фрукт, воду, сок и упакованную выпечку.</p>
        </article>
        <article>
            <div class="page-eyebrow page-eyebrow--dark"><span></span> ДОПОЛНИТЕЛЬНО</div>
            <h2>Платные услуги</h2>
            <ul class="services-checklist">
                <li>услуги прачечной;</li>
                <li>заказ цветов;</li>
                <li>оформление номера к праздничной дате;</li>
                <li>сувенирная продукция, чай, кофе и шоколад.</li>
            </ul>
        </article>
    </div>
</section>

<section class="services-cta">
    <div class="container services-cta__inner">
        <div><div class="page-eyebrow"><span></span> ЛЕРМОНТ</div><h2>Нужна дополнительная услуга?</h2><p>Свяжитесь с нами — администратор уточнит доступность и стоимость.</p></div>
        <div class="services-cta__actions"><a class="btn btn-gold" href="tel:+79282414322">Позвонить</a><a class="about-outline-btn" href="mailto:info@hotel-lermont.ru">Написать</a></div>
    </div>
</section>
@endsection
