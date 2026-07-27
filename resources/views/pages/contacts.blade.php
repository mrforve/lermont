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
                    <div class="contacts-list__item">
                        <span class="contacts-list__icon">⌖</span>
                        <div><small>Адрес</small><strong>353460, г. Геленджик,<br>ул. Первомайская, 7</strong></div>
                    </div>
                    <a class="contacts-list__item" href="tel:+79282414322">
                        <span class="contacts-list__icon">☎</span>
                        <div><small>Телефон</small><strong>+7 (928) 241-43-22</strong></div>
                    </a>
                    <a class="contacts-list__item" href="mailto:info@hotel-lermont.ru">
                        <span class="contacts-list__icon">✉</span>
                        <div><small>Электронная почта</small><strong>info@hotel-lermont.ru</strong></div>
                    </a>
                </div>
                <div class="contacts-actions">
                    <a class="btn btn-gold" href="tel:+79282414322">Позвонить</a>
                    <a class="about-outline-btn" href="https://wa.me/79282414322" target="_blank" rel="noopener">Написать в WhatsApp</a>
                </div>
            </div>
            <div class="contacts-map">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?ll=38.07958%2C44.55988&z=17&pt=38.07958,44.55988,pm2rdm"
                    title="Отель Лермонт на карте"
                    loading="lazy"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
        <div class="contacts-route">
            <div>
                <div class="page-eyebrow page-eyebrow--dark"><span></span> КАК ДОБРАТЬСЯ</div>
                <h2>Постройте маршрут</h2>
                <p>Откройте удобный навигатор — адрес отеля уже указан.</p>
            </div>
            <div class="contacts-route__links">
                <a href="https://www.google.ru/maps?newwindow=1&q=%D0%BE%D1%82%D0%B5%D0%BB%D1%8C+%D0%BB%D0%B5%D1%80%D0%BC%D0%BE%D0%BD%D1%82+%D0%B3%D0%B5%D0%BB%D0%B5%D0%BD%D0%B4%D0%B6%D0%B8%D0%BA" target="_blank" rel="noopener">Google Maps</a>
                <a href="https://yandex.ru/maps/-/CCVPFBOU" target="_blank" rel="noopener">Яндекс Карты</a>
                <a href="https://m.2gis.ru/gelendzhik/firm/70000001006398601?m=38.07958%2C44.55988%2F18" target="_blank" rel="noopener">2ГИС</a>
            </div>
        </div>
        <div class="contacts-bottom-grid">
            <div class="contacts-legal">
                <div class="page-eyebrow page-eyebrow--dark"><span></span> РЕКВИЗИТЫ</div>
                <h2>Юридическая информация</h2>
                <dl>
                    <div><dt>Наименование</dt><dd>ИП Стефанова И.Г.</dd></div>
                    <div><dt>ОГРН</dt><dd>316230400053708</dd></div>
                    <div><dt>ИНН</dt><dd>230404441527</dd></div>
                </dl>
            </div>
            <div class="contacts-socials">
                <div class="page-eyebrow page-eyebrow--dark"><span></span> МЫ НА СВЯЗИ</div>
                <h2>Социальные сети</h2>
                <div class="contacts-socials__grid">
                    <a href="https://t.me/hotel_lermont_gel" target="_blank" rel="noopener">Telegram</a>
                    <a href="https://wa.me/79282414322" target="_blank" rel="noopener">WhatsApp</a>
                    <a href="https://vk.com/hotellermont" target="_blank" rel="noopener">ВКонтакте</a>
                    <a href="https://ok.ru/group/62027103731756" target="_blank" rel="noopener">Одноклассники</a>
                    <a href="https://www.tripadvisor.ru/Hotel_Review-g298514-d12824127-Reviews-Hotel_Lermont-Gelendzhik_Gelendzhiksky_District_Krasnodar_Krai_Southern_District.html" target="_blank" rel="noopener">Tripadvisor</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.contact-form', [
    'type' => \App\Models\ContactRequest::TYPE_MESSAGE,
    'title' => 'Напишите нам',
])
@endsection
