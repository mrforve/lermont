<footer class="footer" id="contacts">
    <div class="container">
        <div class="row gy-4 align-items-start">
            <div class="col-lg-4 col-md-6">
                <a class="site-logo footer-logo" href="{{ route('home') }}" aria-label="{{ $settings?->site_name ?? 'Лермонт отель' }}">
                    @if ($settings?->logo_dark)
                        <img
                            src="{{ asset('storage/' . $settings->logo_dark) }}"
                            alt="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                            class="site-logo__image"
                        >
                    @elseif ($settings?->logo)
                        <img
                            src="{{ asset('storage/' . $settings->logo) }}"
                            alt="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                            class="site-logo__image"
                        >
                    @else
                        <span class="site-logo__mark">Л</span><span class="site-logo__text">ЛЕРМОНТ</span><span class="site-logo__sub">отель</span>
                    @endif
                </a>
                <p class="mt-3 mb-3">Камерный отель в центре Геленджика.<br>Тишина, комфорт и забота в каждой детали.</p>
                @include('partials.external-links', ['includeMaps' => true])
            </div>

            <div class="col-lg-3 col-md-6">
                <h6>Информация</h6>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/services') }}">Услуги</a></li>
                    <li><a href="{{ url('/gallery') }}">Галерея</a></li>
                    <li><a href="{{ route('reviews') }}">Отзывы</a></li>
                    <li><a href="{{ route('lk') }}">Личный кабинет гостя</a></li>
                    <li><a href="{{ url('/about') }}">Об отеле</a></li>
                    <li><a href="{{ url('/contacts') }}">Как добраться</a></li>
                    <li><a href="{{ asset('documents/consumer/pravila-prozhivaniya-i-predostavleniya-uslug-1.pdf') }}" target="_blank" rel="noopener noreferrer">Правила проживания</a></li>
                    <li><a href="{{ url('/ugolok-potrebitelya') }}">Уголок потребителя</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6>Контакты</h6>
                <ul class="list-unstyled mb-0 footer-contacts">
                    <li>353460, г. Геленджик,<br>ул. Первомайская, 7</li>
                    <li><a href="tel:+79282414322">+7 (928) 241-43-22</a></li>
                    <li><a href="mailto:info@hotel-lermont.ru">info@hotel-lermont.ru</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-actions">
                <a class="btn btn-outline-light w-100 mb-3" href="{{ route('booking') }}">Забронировать</a>
				<a href="https://max.ru/u/f9LHodD0cOK4G43DwSuPA5VIJa5VpTvBReELJPM9XQC3q5I1UzjmGjBXVVA"
				   class="footer-whatsapp"
				   target="_blank"
				   rel="noopener noreferrer">
					Напишите нам в MAX
				</a>
            </div>
        </div>

        <hr class="my-4">
        <div class="footer-bottom d-flex flex-wrap justify-content-between gap-3 small">
            <span>© {{ now()->year }} {{ $settings?->site_name ?? 'Отель Лермонт' }}. Все права защищены.</span>
            <span class="d-flex flex-wrap gap-4">
                <a href="{{ asset('documents/consumer/politika-po-obrabotke-personalnyh-dannyh.pdf') }}" target="_blank" rel="noopener noreferrer">Политика конфиденциальности</a>
                <a href="{{ asset('documents/consumer/soglasie-na-obrabotku-1.pdf') }}" target="_blank" rel="noopener noreferrer">Согласие на обработку персональных данных</a>
            </span>
        </div>
    </div>
</footer>
