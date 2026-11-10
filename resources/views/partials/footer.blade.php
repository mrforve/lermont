<footer class="footer" id="contacts">
    <div class="container">
        <div class="row gy-4 align-items-start">
            <div class="col-lg-4 col-md-6">
                <a class="site-logo footer-logo" href="{{ route('home') }}" aria-label="{{ $settings?->site_name ?? 'Лермонт отель' }}">
                    @if ($settings?->logo_dark)
                        <img
                            src="{{ \App\Support\ResponsiveImage::url(asset('storage/' . $settings->logo_dark), 480) }}"
                            alt="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                            class="site-logo__image" width="480" height="131" decoding="async"
                        >
                    @elseif ($settings?->logo)
                        <img
                            src="{{ \App\Support\ResponsiveImage::url(asset('storage/' . $settings->logo), 480) }}"
                            alt="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                            class="site-logo__image" width="480" height="131" decoding="async"
                        >
                    @else
                        <span class="site-logo__mark">Л</span><span class="site-logo__text">ЛЕРМОНТ</span><span class="site-logo__sub">отель</span>
                    @endif
                </a>
                <p class="mt-3 mb-3">Камерный отель в центре Геленджика.<br>Тишина, комфорт и забота в каждой детали.</p>
                @include('partials.external-links', ['includeMaps' => true])
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="h6 footer-title">Информация</div>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/services') }}">Услуги</a></li>
                    <li><a href="{{ url('/gallery') }}">Галерея</a></li>
                    <li><a href="{{ route('reviews') }}">Отзывы</a></li>
                    <li><a href="{{ route('lk') }}">Личный кабинет гостя</a></li>
                    <li><a href="{{ url('/about') }}">Об отеле</a></li>
                    <li><a href="{{ url('/contacts') }}">Как добраться</a></li>
                    <li><a href="{{ asset('documents/consumer/pravila-prozhivaniya.pdf') }}" target="_blank" rel="noopener noreferrer">Правила проживания</a></li>
                    <li><a href="{{ url('/ugolok-potrebitelya') }}">Уголок потребителя</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="h6 footer-title">Контакты</div>
                <ul class="list-unstyled mb-0 footer-contacts">
                    <li>353460, г. Геленджик,<br>ул. Первомайская, 7</li>
                    <li><a href="tel:+79282414322">+7 (928) 241-43-22</a></li>
                    <li><a href="mailto:info@hotel-lermont.ru">info@hotel-lermont.ru</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-actions">
                <a class="btn btn-outline-light w-100 mb-3" href="{{ route('booking') }}">Забронировать</a>
				<div class="mt-3">
                    <iframe title="Рейтинг отеля Лермонт на Яндекс Картах" data-lazy-src="https://yandex.ru/sprav/widget/rating-badge/1197698407?type=award" width="150" height="50" frameborder="0"></iframe>
                </div>
                <div class="mt-3">
                    <iframe title="Рейтинг отеля Лермонт в 2ГИС" id="medium_light_70000001006398601" frameborder="0" width="150px" height="50px" sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation" data-widget-content="PGhlYWQ+PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPgogICAgd2luZG93Ll9fc2l6ZV9fPSdtZWRpdW0nOwogICAgd2luZG93Ll9fdGhlbWVfXz0nbGlnaHQnOwogICAgd2luZG93Ll9fYnJhbmNoSWRfXz0nNzAwMDAwMDEwMDYzOTg2MDEnCiAgICB3aW5kb3cuX19vcmdJZF9fPScnCiAgIDwvc2NyaXB0PjxzY3JpcHQgY3Jvc3NvcmlnaW49ImFub255bW91cyIgdHlwZT0ibW9kdWxlIiBzcmM9Imh0dHBzOi8vZGlzay4yZ2lzLmNvbS93aWRnZXQtY29uc3RydWN0b3IvYXNzZXRzL2lmcmFtZS5qcyI+PC9zY3JpcHQ+PGxpbmsgcmVsPSJtb2R1bGVwcmVsb2FkIiBjcm9zc29yaWdpbj0iYW5vbnltb3VzIiBocmVmPSJodHRwczovL2Rpc2suMmdpcy5jb20vd2lkZ2V0LWNvbnN0cnVjdG9yL2Fzc2V0cy9kZWZhdWx0cy5qcyI+PGxpbmsgcmVsPSJzdHlsZXNoZWV0IiBjcm9zc29yaWdpbj0iYW5vbnltb3VzIiBocmVmPSJodHRwczovL2Rpc2suMmdpcy5jb20vd2lkZ2V0LWNvbnN0cnVjdG9yL2Fzc2V0cy9kZWZhdWx0cy5jc3MiPjwvaGVhZD48Ym9keT48ZGl2IGlkPSJpZnJhbWUiPjwvZGl2PjwvYm9keT4="></iframe>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <div class="footer-bottom d-flex flex-wrap justify-content-between gap-3 small">
            <span>© {{ now()->year }} {{ $settings?->site_name ?? 'Отель Лермонт' }}. Все права защищены.</span>
            <span class="d-flex flex-wrap gap-4">
                <a href="{{ asset('documents/consumer/politika-konfidencialnosti.pdf') }}" target="_blank" rel="noopener noreferrer">Политика конфиденциальности</a>
                <a href="{{ asset('documents/consumer/politika-obrabotki-personalnyh-dannyh.pdf') }}" target="_blank" rel="noopener noreferrer">Политика обработки персональных данных</a>
                <a href="{{ asset('documents/consumer/soglasie-na-obrabotku-personalnyh-dannyh.pdf') }}" target="_blank" rel="noopener noreferrer">Согласие на обработку персональных данных</a>
            </span>
        </div>
    </div>
</footer>
