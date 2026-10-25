@foreach ($blocks as $block)
    @php
        $type = $block['type'] ?? null;
        $data = $block['data'] ?? [];
    @endphp

    @switch($type)
        @case('text')
            <section class="content-block content-block--text">
                @if (!empty($data['title']))
                    <h2>{{ $data['title'] }}</h2>
                @endif

                {!! $data['content'] ?? '' !!}
            </section>
            @break

        @case('image')
            @php
                $width = $data['width'] ?? null;
                $height = $data['height'] ?? null;
                $fit = $data['fit'] ?? 'contain';
                $position = $data['position'] ?? 'full';

                $style = [];

                if ($width) {
                    $style[] = '--content-image-width:' . $width;
                }

                if ($height) {
                    $style[] = '--content-image-height:' . $height;
                }

                if ($fit) {
                    $style[] = '--content-image-fit:' . $fit;
                }
            @endphp

            <section class="content-block content-block--image content-block--image-{{ $position }}">
                @if (!empty($data['image']))
                    <figure>
                        <img
                            src="{{ asset('storage/' . $data['image']) }}"
                            alt="{{ $data['alt'] ?? '' }}"
                            @if ($style)
                                style="{{ implode(';', $style) }}"
                            @endif
                        >

                        @if (!empty($data['caption']))
                            <figcaption>{{ $data['caption'] }}</figcaption>
                        @endif
                    </figure>
                @endif
            </section>
            @break

        @case('gallery')
            @php
                $images = $data['images'] ?? [];
            @endphp

            @if (!empty($images))
                <section class="content-block content-block--gallery">

                    @if (!empty($data['title']))
                        <div class="content-gallery__head">
                            <span class="content-gallery__eyebrow">Галерея</span>
                            <h2>{{ $data['title'] }}</h2>
                        </div>
                    @endif

                    <div class="content-gallery">
                        @foreach ($images as $index => $image)
                            <a
                                href="{{ asset('storage/' . $image) }}"
                                class="content-gallery__item content-gallery__item--{{ ($index % 5) + 1 }}"
                                data-content-gallery-image
                            >
                                <img
                                    src="{{ asset('storage/' . $image) }}"
                                    alt="{{ $data['title'] ?? 'Галерея' }}"
                                    loading="lazy"
                                >

                                <span class="content-gallery__zoom">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <circle cx="11" cy="11" r="6.5"></circle>
                                        <path d="M16 16L21 21"></path>
                                        <path d="M11 8V14"></path>
                                        <path d="M8 11H14"></path>
                                    </svg>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
            @break

        @case('features')
            <section class="content-block content-block--features">
                @if (!empty($data['title']))
                    <h2>{{ $data['title'] }}</h2>
                @endif

                <div class="features">
                    @foreach ($data['items'] ?? [] as $item)
                        <article class="feature">
                            <h3>{{ $item['title'] ?? '' }}</h3>

                            @if (!empty($item['description']))
                                <p>{{ $item['description'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>
            @break

        @case('button')
            <section class="content-block content-block--button">
                <a
                    href="{{ $data['url'] ?? '#' }}"
                    class="button button--{{ $data['style'] ?? 'primary' }}"
                >
                    {{ $data['text'] ?? 'Подробнее' }}
                </a>
            </section>
            @break

        @case('html')
            <section class="content-block content-block--html">
                {!! $data['html'] ?? '' !!}
            </section>
            @break
    @endswitch
@endforeach

<div class="content-lightbox" data-content-lightbox>
    <button
        type="button"
        class="content-lightbox__close"
        data-content-lightbox-close
        aria-label="Закрыть"
    >
        ×
    </button>

    <button
        type="button"
        class="content-lightbox__nav content-lightbox__nav--prev"
        data-content-lightbox-prev
        aria-label="Предыдущее"
    >
        ‹
    </button>

    <img
        src=""
        alt=""
        class="content-lightbox__image"
        data-content-lightbox-image
    >

    <button
        type="button"
        class="content-lightbox__nav content-lightbox__nav--next"
        data-content-lightbox-next
        aria-label="Следующее"
    >
        ›
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = Array.from(document.querySelectorAll('[data-content-gallery-image]'));
    const lightbox = document.querySelector('[data-content-lightbox]');
    const image = document.querySelector('[data-content-lightbox-image]');
    const close = document.querySelector('[data-content-lightbox-close]');
    const prev = document.querySelector('[data-content-lightbox-prev]');
    const next = document.querySelector('[data-content-lightbox-next]');

    if (!items.length || !lightbox || !image) {
        return;
    }

    let currentIndex = 0;

    function show(index) {
        currentIndex = (index + items.length) % items.length;

        image.src = items[currentIndex].getAttribute('href');
        image.alt = items[currentIndex].querySelector('img')?.alt || '';

        lightbox.classList.add('is-open');
        document.body.classList.add('content-lightbox-open');
    }

    function hide() {
        lightbox.classList.remove('is-open');
        document.body.classList.remove('content-lightbox-open');

        setTimeout(() => {
            image.src = '';
        }, 250);
    }

    items.forEach((item, index) => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            show(index);
        });
    });

    close?.addEventListener('click', hide);

    prev?.addEventListener('click', function () {
        show(currentIndex - 1);
    });

    next?.addEventListener('click', function () {
        show(currentIndex + 1);
    });

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            hide();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (!lightbox.classList.contains('is-open')) {
            return;
        }

        if (event.key === 'Escape') {
            hide();
        }

        if (event.key === 'ArrowLeft') {
            show(currentIndex - 1);
        }

        if (event.key === 'ArrowRight') {
            show(currentIndex + 1);
        }
    });
});
</script>