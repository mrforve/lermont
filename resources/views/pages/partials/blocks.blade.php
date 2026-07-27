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
            <section class="content-block content-block--image">
                @if (!empty($data['image']))
                    <figure>
                        <img
                            src="{{ asset('storage/' . $data['image']) }}"
                            alt="{{ $data['alt'] ?? '' }}"
                        >

                        @if (!empty($data['caption']))
                            <figcaption>{{ $data['caption'] }}</figcaption>
                        @endif
                    </figure>
                @endif
            </section>
            @break

        @case('gallery')
            <section class="content-block content-block--gallery">
                @if (!empty($data['title']))
                    <h2>{{ $data['title'] }}</h2>
                @endif

                <div class="gallery">
                    @foreach ($data['images'] ?? [] as $image)
                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt=""
                        >
                    @endforeach
                </div>
            </section>
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