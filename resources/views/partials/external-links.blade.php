@php
    $includeMaps = $includeMaps ?? true;
    $externalLinks = [
        ['key' => 'google', 'label' => 'Google Maps', 'url' => 'https://www.google.ru/maps?newwindow=1&q=%D0%BE%D1%82%D0%B5%D0%BB%D1%8C+%D0%BB%D0%B5%D1%80%D0%BC%D0%BE%D0%BD%D1%82+%D0%B3%D0%B5%D0%BB%D0%B5%D0%BD%D0%B4%D0%B6%D0%B8%D0%BA', 'map' => true],
        ['key' => 'yandex', 'label' => 'Яндекс Карты', 'url' => 'https://yandex.ru/maps/-/CCVPFBOU', 'map' => true],
        ['key' => '2gis', 'label' => '2ГИС', 'url' => 'https://m.2gis.ru/gelendzhik/firm/70000001006398601?m=38.07958%2C44.55988%2F18', 'map' => true],
        ['key' => 'telegram', 'label' => 'Telegram', 'url' => 'https://t.me/hotel_lermont_gel', 'map' => false],
        ['key' => 'whatsapp', 'label' => 'WhatsApp', 'url' => 'https://wa.me/79282414322', 'map' => false],
        ['key' => 'tripadvisor', 'label' => 'Tripadvisor', 'url' => 'https://www.tripadvisor.ru/Hotel_Review-g298514-d12824127-Reviews-Hotel_Lermont-Gelendzhik_Gelendzhiksky_District_Krasnodar_Krai_Southern_District.html', 'map' => false],
        ['key' => 'ok', 'label' => 'Одноклассники', 'url' => 'https://ok.ru/group/62027103731756', 'map' => false],
        ['key' => 'vk', 'label' => 'ВКонтакте', 'url' => 'https://vk.com/hotellermont', 'map' => false],
        ['key' => 'rutube', 'label' => 'Rutube', 'url' => 'https://rutube.ru/channel/44802930/', 'map' => false],
        ['key' => 'dzen', 'label' => 'Дзен', 'url' => 'https://dzen.ru/hotellermont', 'map' => false],
    ];
@endphp

<div class="external-links" aria-label="Карты, мессенджеры и социальные сети">
    @foreach ($externalLinks as $link)
        @continue(!$includeMaps && $link['map'])
        <a class="external-links__item external-links__item--{{ $link['key'] }}"
           href="{{ $link['url'] }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="{{ $link['label'] }}"
           title="{{ $link['label'] }}">
            @switch($link['key'])
                @case('google')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 12.2c0-.7-.1-1.4-.2-2H12v3.8h5.4a4.6 4.6 0 0 1-2 3v2.5h3.3c1.9-1.8 2.9-4.4 2.9-7.3Z"/><path d="M12 22c2.7 0 5-.9 6.7-2.5l-3.3-2.5c-.9.6-2.1 1-3.4 1a6 6 0 0 1-5.7-4.1H2.9v2.6A10 10 0 0 0 12 22Z"/><path d="M6.3 13.9A6 6 0 0 1 6 12c0-.7.1-1.3.3-1.9V7.5H2.9A10 10 0 0 0 2 12c0 1.6.4 3.2.9 4.5l3.4-2.6Z"/><path d="M12 6c1.5 0 2.8.5 3.9 1.5l2.9-2.9A9.8 9.8 0 0 0 12 2a10 10 0 0 0-9.1 5.5l3.4 2.6A6 6 0 0 1 12 6Z"/></svg>
                    @break
                @case('yandex')
                    <svg viewBox="0 0 48 48" aria-hidden="true"><path d="M24 3a21 21 0 1 0 0 42 21 21 0 0 0 0-42Zm7 31h-5V17h-2c-4 0-5 5-2 7l3 3-6 7h-6l6-8c-5-6-2-14 6-14h6v22Z"/></svg>
                    @break
                @case('2gis')
                    <svg viewBox="0 0 64 24" aria-hidden="true"><path d="M8 2a8 8 0 0 0-8 8c0 6 8 12 8 12s8-6 8-12a8 8 0 0 0-8-8Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/><path d="M20 5h10v4h-6v2h5v4h-5v2h6v4H20V5Zm13 0h5v16h-5V5Zm8 0h11c6 0 10 3 10 8s-4 8-10 8H41V5Zm5 4v8h5c3 0 5-1 5-4s-2-4-5-4h-5Z"/></svg>
                    @break
                @case('telegram')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4 18 20c-.2 1-1 1.2-1.8.7l-4.6-3.4-2.2 2.1c-.2.3-.4.5-.9.5l.3-4.7 8.6-7.8c.4-.3-.1-.5-.6-.2L6.2 14 1.6 12.5c-1-.3-1-1 .2-1.4L19.8 4c.8-.3 1.6.2 1.2 0Z"/></svg>
                    @break
                @case('whatsapp')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11.7 11.7 0 0 0 12.2 0C5.8 0 .6 5.2.6 11.6c0 2 .5 4 1.5 5.7L0 24l6.9-1.8c1.6.9 3.4 1.3 5.3 1.3 6.4 0 11.6-5.2 11.6-11.6 0-3.1-1.2-6-3.3-8.4Zm-8.3 18c-1.7 0-3.4-.5-4.8-1.3l-.3-.2-4.1 1.1 1.1-4-.2-.4a9.6 9.6 0 1 1 8.3 4.8Zm5.3-7.2c-.3-.2-1.7-.9-2-.9-.3-.1-.5-.2-.7.2l-1 1.2c-.2.2-.4.3-.7.1-2-.9-3.3-1.7-4.6-4-.3-.5.3-.5.9-1.7.1-.2 0-.4 0-.6l-1-2.4c-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.4-.3.4-1.2 1.2-1.2 2.9s1.2 3.3 1.4 3.5c.2.2 2.4 3.7 5.8 5.2.8.3 1.4.5 1.9.7.8.2 1.5.2 2.1.1.6-.1 1.7-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"/></svg>
                    @break
                @case('tripadvisor')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 0 0-5.2 1.7H3l1.8 2A5.3 5.3 0 1 0 12 14l2.1 2.3 2.1-2.3A5.3 5.3 0 1 0 19.2 6L21 4.7h-3.8A9 9 0 0 0 12 3ZM7 14.4a3.3 3.3 0 1 1 0-6.6 3.3 3.3 0 0 1 0 6.6Zm10 0a3.3 3.3 0 1 1 0-6.6 3.3 3.3 0 0 1 0 6.6ZM7 9.4a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4Zm10 0a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4Z"/></svg>
                    @break
                @case('ok')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm5.5 8.5c.7.9.5 2.2-.4 2.9-1 .7-2.1 1.2-3.2 1.4l3 3a2 2 0 0 1-2.8 2.8L12 20.5l-2.1 3.1A2 2 0 1 1 7 20.8l3-3a11 11 0 0 1-3.2-1.4 2 2 0 0 1 2.1-3.4 6 6 0 0 0 6.2 0c.8-.5 1.8-.3 2.4.5Z"/></svg>
                    @break
                @case('vk')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7.3c.1 6 3.1 9.7 8.2 9.7h.7v-3.4c2 .2 3.4 1.5 4.1 3.4h3.7c-.9-2.8-2.8-4.4-4-5.1 1.2-.8 2.9-2.8 3.3-5.1h-3.4c-.7 2-2.2 3.8-3.7 4V6.8H8.6v6.9C7 13.3 5.1 11.4 5 6.8H3v.5Z"/></svg>
                    @break
                @case('rutube')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5h10c4 0 7 2 7 5.5 0 2.4-1.3 4.1-3.6 5l4.1 3.5h-5.2l-3.5-3H8v3H3V5Zm5 4v3h5c1.3 0 2-.5 2-1.5S14.3 9 13 9H8Z"/></svg>
                    @break
                @case('dzen')
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2c0 5.5-1.5 7-7 7 5.5 0 7 1.5 7 7 0-5.5 1.5-7 7-7-5.5 0-7-1.5-7-7Zm0 20c0-4.7-1.3-6-6-6 4.7 0 6-1.3 6-6 0 4.7 1.3 6 6 6-4.7 0-6 1.3-6 6Z"/></svg>
                    @break
            @endswitch
            <span class="visually-hidden">{{ $link['label'] }}</span>
        </a>
    @endforeach
</div>
