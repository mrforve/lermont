@php
    $gallery = collect($page->blocks ?? [])->where('type', 'gallery')->flatMap(fn ($block) => $block['data']['images'] ?? [])->values();
    $photos = $gallery->isNotEmpty() ? $gallery : collect(['pages/galleries/01M5DEF88FR3RE30EFQY4DBJBP.jpg', 'pages/galleries/01M5DEF88EFZP1829GJW7JR4RX.jpg']);
    $offers = [
        ['coffee', 'Праздничный завтрак', 'Каждое утро на протяжении всех каникул', 'breakfast'],
        ['dish', 'Праздничное меню', 'Особое меню в ресторане отеля на протяжении всех новогодних каникул', 'menu'],
        ['glasses', 'Алкогольные напитки', 'Комплиментарно для гостей', 'drinks'],
        ['gift', 'Подарки 1 января', 'Всем гостям праздничные комплименты', 'gift'],
        ['cocktail', 'Ночной фуршет', 'С 23:00 31 декабря до 01:00 1 января. Лёгкие закуски, напитки и праздничная атмосфера', 'buffet'],
    ];
    $places = [
        ['waves', 'Рядом с морем', 'Несколько минут пешком', 'sea'],
        ['music', 'Вся городская анимация', 'Праздничные мероприятия в шаговой доступности', 'city'],
        ['tree', 'В 2 минутах от центральной ёлки', 'Главная новогодняя площадь Геленджика', 'tree'],
        ['spark', 'Праздничный Геленджик', 'Концерты, фейерверки и яркая атмосфера города', 'fireworks'],
    ];
@endphp
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#650b1b">
    <title>{{ $page->seo_title ?: $page->title }} — отель «Лермонт»</title>
    <meta name="description" content="{{ $page->seo_description ?: 'Встречайте Новый год 2027 в отеле «Лермонт» у моря в Геленджике. Праздничные завтраки, особое меню и новогодняя атмосфера.' }}">
    <link rel="canonical" href="{{ url('/novyi-god-2027-v-gelendzike') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/new-year.css') }}?v=20261025-1">
    <script src="{{ asset('js/new-year.js') }}?v=20261025-1" defer></script>
</head>
<body class="ny">
<svg xmlns="http://www.w3.org/2000/svg" class="ny-symbols" aria-hidden="true"><defs>
    <symbol id="ny-arrow" viewBox="0 0 24 24"><path d="M4 12h15m-6-6 6 6-6 6"/></symbol>
    <symbol id="ny-calendar" viewBox="0 0 32 32"><rect x="5" y="7" width="22" height="22" rx="2"/><path d="M10 3v8m12-8v8M5 14h22m-17 5h2m4 0h2m4 0h1m-13 5h2m4 0h2m4 0h1"/></symbol>
    <symbol id="ny-coffee" viewBox="0 0 32 32"><path d="M7 13h15v7a7 7 0 0 1-15 0zm15 1h2a4 4 0 0 1 0 8h-2M4 29h23M11 9c-4-4 4-4 0-8m6 8c-4-4 4-4 0-8"/></symbol>
    <symbol id="ny-dish" viewBox="0 0 32 32"><path d="M4 23h24M6 23a10 10 0 0 1 20 0M16 10V7m-3 0h6M3 27h26"/></symbol>
    <symbol id="ny-glasses" viewBox="0 0 32 32"><path d="m6 3-3 12a5 5 0 0 0 9 3l4-12zm1 18-2 8m-3-1 7 2M24 3l5 11a5 5 0 0 1-8 5L15 8zm1 19 2 7m-4 1 7-2M4 12l9 3m6-1 8-3"/></symbol>
    <symbol id="ny-gift" viewBox="0 0 32 32"><path d="M5 14h22v15H5zM3 9h26v6H3zm13 0v20M16 9C3 9 7-3 13 4zm0 0c13 0 9-12 3-5z"/></symbol>
    <symbol id="ny-cocktail" viewBox="0 0 32 32"><path d="m4 7 12 13L28 7ZM16 20v9m-6 0h12M20 7l5-6M9 12h14"/></symbol>
    <symbol id="ny-pin" viewBox="0 0 32 40"><path d="M29 15c0 10-13 23-13 23S3 25 3 15a13 13 0 0 1 26 0Z"/><circle cx="16" cy="15" r="5"/></symbol>
    <symbol id="ny-waves" viewBox="0 0 32 32"><path d="M2 10q4-5 8 0t8 0 8 0l4-2M2 17q4-5 8 0t8 0 8 0l4-2M2 24q4-5 8 0t8 0 8 0l4-2"/></symbol>
    <symbol id="ny-music" viewBox="0 0 32 32"><path d="M12 24V7l16-4v18M12 13l16-4"/><ellipse cx="7" cy="25" rx="5" ry="4"/><ellipse cx="23" cy="22" rx="5" ry="4"/></symbol>
    <symbol id="ny-tree" viewBox="0 0 32 32"><path d="m16 2-8 10h4L5 21h5l-7 7h26l-7-7h5l-7-9h4ZM16 28v4"/></symbol>
    <symbol id="ny-spark" viewBox="0 0 32 32"><path d="M16 1v8m0 14v8M1 16h8m14 0h8M5 5l6 6m10 10 6 6M5 27l6-6M21 11l6-6M16 12v8m-4-4h8"/></symbol>
</defs></svg>
<main>
    <section class="ny-hero" aria-labelledby="ny-title">
        <div class="ny-hero__inner ny-wrap">
            <div class="ny-hero__copy">
                <a class="ny-logo" href="{{ route('home') }}" aria-label="Отель Лермонт — главная"><img src="{{ asset('img/logo_dark.png') }}" alt="Lermont Hotel" width="160" height="100"></a>
                <h1 id="ny-title">Новый год <strong>2027</strong><span>в Лермонте</span></h1>
                <p>У моря. В атмосфере уюта<br>и праздничного Геленджика.</p>
                <a class="ny-button" href="#ny-booking">Забронировать номер <svg><use href="#ny-arrow"/></svg></a>
            </div>
        </div>
    </section>
    <div class="ny-wrap ny-content">
        <section class="ny-booking" id="ny-booking" aria-labelledby="ny-booking-title">
            <div class="ny-booking__intro"><svg class="ny-gold-icon"><use href="#ny-calendar"/></svg><div><h2 id="ny-booking-title">Новогодние каникулы<br>в Лермонте</h2><p>Выберите даты проживания<br>и забронируйте номер заранее.</p></div></div>
            <form class="ny-form" action="{{ route('booking') }}" method="get" data-booking-form>
                <div class="ny-form__dates"><label>Заезд<input type="date" name="date" value="2026-12-29" required aria-label="Дата заезда"></label><label>Выезд<input type="date" name="departure" value="2027-01-10" required aria-label="Дата выезда"></label></div>
                <input type="hidden" name="nights" value="12">
                <button class="ny-button" type="submit">Показать номера <svg><use href="#ny-arrow"/></svg></button>
                <p class="ny-form__note">Вы можете выбрать любые даты в период новогодних каникул</p>
                <noscript><p>Выберите даты проживания в модуле бронирования на следующей странице.</p></noscript>
            </form>
            <p class="ny-booking__wish">Проведите<br>новогодние каникулы<br>у моря <span>❄</span></p>
        </section>
        <section class="ny-offer" aria-labelledby="ny-offer-title">
            <div class="ny-offer__heading"><h2 id="ny-offer-title">Праздничное<br>предложение <span aria-hidden="true">❄</span></h2><p>Встречайте Новый год 2027 в камерном отеле «Лермонт» —<br class="ny-desktop"> в самом сердце Геленджика, в нескольких минутах от моря.<br class="ny-desktop"> Для вас — особая праздничная атмосфера, вкусная кухня, комплименты<br class="ny-desktop"> и забота в каждой детали.</p></div>
            <div class="ny-offer__grid">
                @foreach ($offers as [$icon, $title, $text, $image])
                    <article class="ny-offer-card"><div class="ny-offer-card__photo ny-food--{{ $image }}" role="img" aria-label="{{ $title }}"></div><span class="ny-badge"><svg><use href="#ny-{{ $icon }}"/></svg></span><div class="ny-offer-card__copy"><h3>{{ $title }}</h3><p>{{ $text }}</p></div></article>
                @endforeach
            </div>
        </section>
        <section class="ny-location" aria-labelledby="ny-location-title">
            <div class="ny-location__intro"><svg class="ny-gold-icon"><use href="#ny-pin"/></svg><div><h2 id="ny-location-title">Идеальное<br>расположение</h2><p>Вы в центре событий<br>и праздничной жизни города.</p></div></div>
            @foreach ($places as [$icon, $title, $text, $image])
                <article class="ny-place"><div class="ny-place__photo ny-place--{{ $image }}"><span class="ny-badge"><svg><use href="#ny-{{ $icon }}"/></svg></span></div><h3>{{ $title }}</h3><p>{{ $text }}</p></article>
            @endforeach
        </section>
        <section class="ny-gallery" aria-labelledby="ny-gallery-title">
            <div class="ny-gallery__intro"><h2 id="ny-gallery-title">Атмосфера<br>праздника</h2><p>Фотографии нашего отеля<br>и новогоднего Геленджика</p><div class="ny-gallery__controls"><button type="button" data-gallery-step="-1" aria-label="Предыдущие фотографии">←</button><button type="button" data-gallery-step="1" aria-label="Следующие фотографии">→</button></div></div>
            <div class="ny-gallery__track" data-gallery-track tabindex="0" role="region" aria-label="Фотографии отеля. Листайте стрелками или проведите пальцем">
                @foreach ($photos as $photo)
                    <a class="ny-gallery__item" href="{{ asset('storage/' . $photo) }}" data-gallery-image><img src="{{ asset('storage/' . $photo) }}" alt="Новогодняя атмосфера отеля «Лермонт» — фото {{ $loop->iteration }}" loading="lazy" width="400" height="300"></a>
                @endforeach
            </div>
        </section>
    </div>
    <section class="ny-cta"><div class="ny-wrap ny-cta__inner"><div class="ny-cta__decoration" aria-hidden="true"><img src="{{ asset('img/new-year/gifts.webp') }}" alt="" width="240" height="360" loading="lazy"></div><div><h2>Забронируйте<br>новогодний отдых в Лермонте</h2><p>Подарите себе и близким особенные каникулы у моря</p></div><div class="ny-cta__action"><a class="ny-button ny-button--gold" href="#ny-booking">Выбрать номер <svg><use href="#ny-arrow"/></svg></a><p>Количество номеров ограничено</p></div></div></section>
</main>
<footer class="ny-footer ny-wrap"><a href="{{ route('home') }}">Отель «Лермонт»</a><span>Геленджик · ул. Первомайская, 7</span><a href="tel:+79282414322">+7 (928) 241-43-22</a></footer>
<dialog class="ny-lightbox" data-lightbox aria-label="Просмотр фотографии"><button type="button" data-lightbox-close aria-label="Закрыть фотографию">×</button><img src="" alt=""></dialog>
</body>
</html>
