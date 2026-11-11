@extends('layouts.app')

@section('title', $page->seo_title ?: $page->title)

@section('content')
<section class="contacts-hero">
    <div class="container contacts-hero__content">
        <div class="page-eyebrow"><span></span> ЛЕРМОНТ</div>
        <h1>{{ $page->title ?: 'Контакты' }}</h1>
        <p>Мы находимся в самом центре Геленджика, в нескольких минутах от набережной.</p>
    </div>
</section>
<section class="contacts-main page-section">
    <div class="container">
        <div class="contacts-grid">
            <div class="contacts-card contacts-card--primary">
                <div class="page-eyebrow page-eyebrow--dark"><span></span> КОНТАКТЫ</div>
                <h2>Свяжитесь с нами</h2>
                <div class="contacts-list">
                    @if($settings?->address)
                    <div class="contacts-list__item">
                        <span class="contacts-list__icon">⌖</span>
                        <div><small>Адрес</small><strong>{!! nl2br(e($settings?->address)) !!}</strong></div>
                    </div>
                    @endif
                    @foreach (['phone'=>'Телефон','phone_secondary'=>'Дополнительный телефон'] as $field=>$label)
                        @if($phoneHref = \App\Support\PublicContacts::phone($settings?->{$field}))
                        <a class="contacts-list__item" href="tel:{{ $phoneHref }}"><span class="contacts-list__icon">☎</span><div><small>{{ $label }}</small><strong>{{ $settings->{$field} }}</strong></div></a>
                        @endif
                    @endforeach
                    @if($email = \App\Support\PublicContacts::email($settings?->email))
                    <a class="contacts-list__item" href="mailto:{{ $email }}"><span class="contacts-list__icon">✉</span><div><small>Электронная почта</small><strong>{{ $email }}</strong></div></a>
                    @endif
                    @if($settings?->working_hours)<div class="contacts-list__item"><span class="contacts-list__icon">◷</span><div><small>Время работы</small><strong>{{ $settings->working_hours }}</strong></div></div>@endif
                </div>
                <div class="contacts-actions">
                    @if($phoneHref = \App\Support\PublicContacts::phone($settings?->phone))<a class="btn btn-gold" href="tel:{{ $phoneHref }}">Позвонить</a>@endif
                    @if($maxUrl = \App\Support\PublicContacts::url($settings?->max_chat_url))<a class="about-outline-btn" href="{{ $maxUrl }}" target="_blank" rel="noopener noreferrer">Написать в MAX</a>@endif
                </div>
            </div>
            <div class="contacts-map">
                @if(\App\Support\PublicContacts::url($settings?->map_embed_url))
                <iframe
                    src="{{ \App\Support\PublicContacts::url($settings?->map_embed_url) }}"
                    title="Отель Лермонт на карте"
                    loading="lazy"
                    allowfullscreen
                ></iframe>
                @endif
            </div>
        </div>
        <div class="contacts-route">
            <div>
                <div class="page-eyebrow page-eyebrow--dark"><span></span> КАК ДОБРАТЬСЯ</div>
                <h2>Постройте маршрут</h2>
                <p>Откройте удобный навигатор — адрес отеля уже указан.</p>
            </div>
            <div class="contacts-route__links">
                @foreach (['google','yandex','2gis'] as $key)
                    @if($link = \App\Support\PublicContacts::links($settings)[$key] ?? null)<a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">{{ $link['label'] }}</a>@endif
                @endforeach
            </div>
        </div>
        <div class="contacts-bottom-grid">
            <div class="contacts-legal">
                <div class="page-eyebrow page-eyebrow--dark"><span></span> РЕКВИЗИТЫ</div>
                <h2>Юридическая информация</h2>
                <dl>
                    @if($settings?->company_name)<div><dt>Наименование</dt><dd>{{ $settings?->company_name }}</dd></div>@endif
                    @if($settings?->company_ogrn)<div><dt>ОГРН</dt><dd>{{ $settings?->company_ogrn }}</dd></div>@endif
                    @if($settings?->company_inn)<div><dt>ИНН</dt><dd>{{ $settings?->company_inn }}</dd></div>@endif
                </dl>
            </div>
            <div class="contacts-socials">
                <div class="page-eyebrow page-eyebrow--dark"><span></span> МЫ НА СВЯЗИ</div>
                <h2>Социальные сети</h2>
                <div class="contacts-socials__grid">
                    @foreach (['max_chat','max','vk','ok','rutube','dzen','tripadvisor','telegram','whatsapp','youtube'] as $key)
                        @php($link = \App\Support\PublicContacts::links($settings)[$key] ?? null)
                        @continue(!$link)
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">@include('partials.contact-social-icon')<span>{{ $link['label'] }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.contact-form', [
    'type' => \App\Models\ContactRequest::TYPE_MESSAGE,
    'title' => 'Оставить сообщение',
])
@endsection
