@php
    $includeMaps = $includeMaps ?? true;
    $externalLinks = \App\Support\PublicContacts::links($settings);
    $linkGroups = [
        ['key' => 'social', 'label' => 'Социальные сети', 'keys' => ['vk', 'ok', 'rutube', 'dzen', 'telegram', 'whatsapp', 'youtube', 'max_chat']],
        ['key' => 'maps', 'label' => 'Карты и отзывы', 'keys' => ['google', 'yandex', '2gis', 'tripadvisor']],
        ['key' => 'channel', 'label' => 'Канал в MAX', 'keys' => ['max']],
    ];
@endphp

<div class="external-links-groups">
    @foreach ($linkGroups as $group)
        @continue(!$includeMaps && $group['key'] === 'maps')
        @continue(!array_intersect($group['keys'], array_keys($externalLinks)))
        <div class="external-links__group external-links__group--{{ $group['key'] }}" role="group" aria-label="{{ $group['label'] }}">
            @if ($group['key'] !== 'channel')
                <p class="external-links__heading">{{ $group['label'] }}</p>
            @endif
            <div class="external-links">
    @foreach ($group['keys'] as $key)
        @php($link = $externalLinks[$key] ?? null)
        @continue(!$link)

        <a
            class="external-links__item external-links__item--{{ $link['key'] }}"
            href="{{ $link['url'] }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $link['label'] }}"
            title="{{ $link['label'] }}"
        >
            <span class="external-links__icon">
            @include('partials.external-link-icon')

            </span>
            <span class="external-links__label{{ $group['key'] !== 'channel' ? ' visually-hidden' : '' }}">{{ $link['label'] }}</span>
        </a>
    @endforeach
            </div>
        </div>
    @endforeach
</div>
