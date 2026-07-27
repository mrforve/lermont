@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@section('content')
@php
    $heroImage = $slides->first()?->image;
    $roomImages = $roomTypes
        ->flatMap(function ($roomType) {
            $images = collect();

            if ($roomType->main_image) {
                $images->push([
                    'path' => $roomType->main_image,
                    'alt' => $roomType->name,
                ]);
            }

            foreach ($roomType->images as $image) {
                if ($image->is_active && $image->image) {
                    $images->push([
                        'path' => $image->image,
                        'alt' => $image->alt ?: $roomType->name,
                    ]);
                }
            }

            return $images;
        })
        ->unique('path')
        ->values();

    $imageAt = function (int $index, ?string $fallback = null) use ($roomImages) {
        $image = $roomImages->get($index);

        if ($image) {
            return [
                'url' => asset('storage/' . $image['path']),
                'alt' => $image['alt'],
            ];
        }

        $firstImage = $roomImages->first();

        if ($firstImage) {
            return [
                'url' => asset('storage/' . $firstImage['path']),
                'alt' => $firstImage['alt'],
            ];
        }

        return [
            'url' => $fallback ?: asset('images/about/placeholder.jpg'),
            'alt' => 'Отель Лермонт',
        ];
    };

    $introImage = $imageAt(0);
    $familyImage = $imageAt(1, asset('images/about/family.jpg'));
    $galleryImages = collect([
        $imageAt(2),
        $imageAt(3),
        $imageAt(4),
        $imageAt(5),
    ]);
@endphp

<section
    class="about-hero"
    @if ($heroImage)
        style="--about-hero-image: url('{{ asset('storage/' . $heroImage) }}')"
    @else
        style="--about-hero-image: url('{{ asset('images/about/hero.jpg') }}')"
    @endif
>
    <div class="container about-hero__content">
        <div class="about-eyebrow">ЛЕРМОНТ <span></span></div>

        <h1>Об отеле</h1>

        <p class="about-hero__lead">
            Камерный отель в центре Геленджика — уютное пространство
            для спокойного отдыха, семейных поездок и особенных впечатлений.
        </p>

        <p class="about-hero__note">
            23 номера, парковка и завтраки в двух минутах от набережной.
        </p>

        <button type="button" class="btn btn-gold about-primary-btn">
            Забронировать
        </button>
    </div>
</section>

<section class="about-intro about-section">
    <div class="container">
        <div class="about-split about-split--intro">
            <div class="about-media about-media--intro">
                <img src="{{ $introImage['url'] }}" alt="{{ $introImage['alt'] }}">
            </div>

            <div class="about-copy">
                <div class="about-eyebrow about-eyebrow--dark">ОБ ОТЕЛЕ <span></span></div>
                <h2>Место, куда хочется возвращаться</h2>

                <p>
                    Отель «Лермонт» — камерный отель в самом центре Геленджика.
                    Мы создали пространство, где продумана каждая деталь: от сервиса
                    и интерьеров до атмосферы спокойствия и уюта.
                </p>

                <p>
                    Всего в двух минутах — набережная, кафе и городские
                    достопримечательности, а внутри — тишина, комфорт и внимание
                    к каждому гостю.
                </p>

                <p>
                    Удобное расположение, современные номера, завтраки из свежих
                    продуктов и искреннее южное гостеприимство — всё для отдыха,
                    после которого хочется вернуться снова.
                </p>

                <div class="about-features">
                    <div class="about-feature">
                        <svg viewBox="0 0 32 32" aria-hidden="true"><path d="M5 23V13.5C5 11.6 6.6 10 8.5 10h15c1.9 0 3.5 1.6 3.5 3.5V23M7 18h18M5 25h22"/><path d="M9 18v-3.2c0-1 .8-1.8 1.8-1.8H14c1.1 0 2 .9 2 2v3M16 18v-3c0-1.1.9-2 2-2h3.2c1 0 1.8.8 1.8 1.8V18"/></svg>
                        <strong>23</strong>
                        <span>номера</span>
                    </div>

                    <div class="about-feature">
                        <svg viewBox="0 0 32 32" aria-hidden="true"><path d="M8 9v6c0 4.4 3.6 8 8 8s8-3.6 8-8V9M6 9h20M24 12h2.5c1.5 0 2.5 1.2 2.2 2.7-.4 2.2-2.3 3.8-4.5 3.8M10 27h12"/></svg>
                        <strong>Завтраки</strong>
                        <span>шведский стол</span>
                    </div>

                    <div class="about-feature">
                        <svg viewBox="0 0 32 32" aria-hidden="true"><path d="M6 15.5h20l2 5.5v4H4v-4l2-5.5Z"/><path d="m8.5 15.5 2-5h11l2 5M7 25v2M25 25v2"/><circle cx="9.5" cy="21.5" r="1.4"/><circle cx="22.5" cy="21.5" r="1.4"/></svg>
                        <strong>Парковка</strong>
                        <span>на территории</span>
                    </div>

                    <div class="about-feature">
                        <svg viewBox="0 0 32 32" aria-hidden="true"><path d="M6 13.5C11.5 8 20.5 8 26 13.5M9.5 17c3.6-3.6 9.4-3.6 13 0M13 20.5c1.7-1.7 4.3-1.7 6 0"/><circle cx="16" cy="25" r="1"/></svg>
                        <strong>Wi‑Fi</strong>
                        <span>на всей территории</span>
                    </div>

                    <div class="about-feature">
                        <svg viewBox="0 0 32 32" aria-hidden="true"><path d="M16 29S26 19.9 26 11.8C26 6.4 21.5 2 16 2S6 6.4 6 11.8C6 19.9 16 29 16 29Z"/><circle cx="16" cy="12" r="3.4"/></svg>
                        <strong>2 минуты</strong>
                        <span>до набережной</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-family about-section">
    <div class="container-fluid px-0">
        <div class="about-split about-split--family">
            <div class="about-copy about-family__copy">
                <div class="about-eyebrow about-eyebrow--dark">СЕМЕЙНЫЙ ОТДЫХ <span></span></div>
                <h2>Отдых с семьёй</h2>

                <p>
                    Мы знаем, как важно, чтобы отдых с детьми был комфортным.
                    В «Лермонт» созданы условия для семейных поездок: рядом
                    набережная, кафе, парки и детские площадки, а в отеле —
                    спокойная атмосфера и просторные номера.
                </p>

                <p>
                    Для маленьких гостей предусмотрены детские кроватки,
                    ступеньки и насадки для уборной, книги и настольные игры.
                    На завтраках есть каши, молочные продукты и хлопья.
                </p>

                <div class="about-family__items">
                    <span>Просторные номера</span>
                    <span>Набережная рядом</span>
                    <span>Кафе и парки</span>
                    <span>Удобно с детьми</span>
                </div>
            </div>

            <div class="about-media about-family__media">
                <img src="{{ $familyImage['url'] }}" alt="Семейный отдых в Геленджике">
            </div>
        </div>
    </div>
</section>

<section class="about-atmosphere about-section">
    <div class="container">
        <div class="about-atmosphere__grid">
            <div class="about-copy">
                <div class="about-eyebrow about-eyebrow--dark">ГОСТИ ЛЕРМОНТА <span></span></div>
                <h2>Нас выбирают за атмосферу</h2>

                <p>
                    Гости отмечают камерную атмосферу, уединённость и внимание
                    к деталям. Здесь останавливаются семьи, пары,
                    бизнес-путешественники и известные гости, которые ценят
                    приватность и деликатный сервис.
                </p>

                <p>
                    Более 90% гостей возвращаются снова или рекомендуют отель
                    своим друзьям и близким.
                </p>

                <a href="{{ url('/klub-gostey') }}" class="about-outline-btn">
                    Стать гостем клуба
                </a>
            </div>

            <div class="about-atmosphere__cards">
                @foreach ([
                    ['image' => $imageAt(6), 'title' => 'Камерная атмосфера', 'text' => 'Тишина и уют'],
                    ['image' => $imageAt(7), 'title' => 'Деликатный сервис', 'text' => 'Внимание к деталям'],
                    ['image' => $imageAt(8), 'title' => 'Ваш комфорт', 'text' => 'Забота в каждой мелочи'],
                ] as $card)
                    <article class="about-mood-card">
                        <img src="{{ $card['image']['url'] }}" alt="{{ $card['image']['alt'] }}">
                        <div class="about-mood-card__overlay">
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="about-gallery about-section">
    <div class="container">
        <div class="about-section-heading">
            <div class="about-eyebrow about-eyebrow--dark">ЛЕРМОНТ В ДЕТАЛЯХ <span></span></div>
            <h2>Пространство и детали</h2>
        </div>

        <div class="about-gallery__grid">
            @foreach ([
                ['title' => 'Уютные номера', 'text' => 'Стиль и комфорт'],
                ['title' => 'Завтраки', 'text' => 'Свежие и разнообразные'],
                ['title' => 'Локация', 'text' => 'Центр и близость к морю'],
                ['title' => 'Атмосфера', 'text' => 'Море, воздух и спокойствие'],
            ] as $index => $caption)
                @php($galleryImage = $galleryImages->get($index))
                <figure class="about-gallery-card">
                    <div class="about-gallery-card__image">
                        <img src="{{ $galleryImage['url'] }}" alt="{{ $galleryImage['alt'] }}">
                    </div>
                    <figcaption>
                        <h3>{{ $caption['title'] }}</h3>
                        <p>{{ $caption['text'] }}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

<section class="about-cta">
    <div class="container about-cta__inner">
        <div class="about-cta__leaf" aria-hidden="true"></div>
        <div class="about-cta__content">
            <h2>Ваш отдых начинается здесь</h2>
            <p>
                Забронируйте номер и насладитесь атмосферой уюта
                в самом сердце Геленджика.
            </p>
            <button type="button" class="btn btn-gold about-primary-btn">
                Забронировать номер
            </button>
        </div>
        <div class="about-cta__hotel" aria-hidden="true"></div>
    </div>
</section>
@endsection
