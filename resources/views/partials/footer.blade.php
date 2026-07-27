<footer class="footer" id="contacts">
    <div class="container">
        <div class="row gy-4 align-items-start">
            <div class="col-lg-4 col-md-6">
                <a
                    class="site-logo footer-logo"
                    href="{{ route('home') }}"
                    aria-label="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                >
                    @if ($settings?->logo)
                        <img
                            src="{{ asset('storage/' . $settings->logo) }}"
                            alt="{{ $settings?->site_name ?? 'Лермонт отель' }}"
                            class="site-logo__image"
                        >
                    @else
                        <span class="site-logo__mark">Л</span>
                        <span class="site-logo__text">ЛЕРМОНТ</span>
                        <span class="site-logo__sub">отель</span>
                    @endif
                </a>

                <p class="mt-3 mb-3">
                    {!! nl2br(e(
                        $settings?->footer_text
                        ?: "Камерный отель в центре Геленджика.\nТишина, комфорт и забота в каждой детали."
                    )) !!}
                </p>

                <div
                    class="footer-socials"
                    aria-label="Социальные сети"
                >
                    <a href="#" aria-label="VK">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M4 8.2C4.1 13.6 6.8 17 11.4 17H12V13.9C13.8 14.1 15.1 15.3 15.7 17H19C18.2 14.5 16.5 13 15.4 12.4C16.5 11.7 18 9.9 18.4 7.8H15.4C14.8 9.6 13.4 11.2 12 11.4V7.8H9V14C7.5 13.6 5.8 11.9 5.7 7.8H4V8.2Z"
                                fill="currentColor"
                            />
                        </svg>
                    </a>

                    <a href="#" aria-label="Telegram">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20.5 4.8L17.6 19.1C17.4 20.1 16.8 20.3 16 19.8L11.6 16.5L9.5 18.6C9.3 18.8 9.1 19 8.6 19L8.9 14.5L17.1 7.1C17.5 6.8 17 6.6 16.6 6.9L6.5 13.3L2.1 11.9C1.2 11.6 1.2 11 2.3 10.6L19.4 4C20.2 3.7 20.9 4.2 20.5 4.8Z"
                                fill="currentColor"
                            />
                        </svg>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect
                                x="5"
                                y="5"
                                width="14"
                                height="14"
                                rx="4"
                                stroke="currentColor"
                                stroke-width="1.7"
                            />
                            <circle
                                cx="12"
                                cy="12"
                                r="3.2"
                                stroke="currentColor"
                                stroke-width="1.7"
                            />
                            <circle
                                cx="16.6"
                                cy="7.4"
                                r=".9"
                                fill="currentColor"
                            />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6>Навигация</h6>

                <ul class="list-unstyled mb-0">
                    @foreach ($footerMenu as $item)
                        <li>
                            <a
                                href="{{ $item->resolved_url }}"
                                target="{{ $item->target }}"
                            >
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6>Информация</h6>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#hero">Завтраки</a>
                    </li>

                    <li>
                        <a href="#hero">Парковка</a>
                    </li>

                    <li>
                        <a href="#location">Как добраться</a>
                    </li>

                    <li>
                        <a href="{{ url('/personal-data-consent') }}">
                            Правила проживания
                        </a>
                    </li>

                    <li>
                        <a href="#contacts">
                            Вопросы и ответы
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6>Контакты</h6>

                <ul class="list-unstyled mb-0 footer-contacts">
                    <li>
                        {!! nl2br(e(
                            $settings?->address
                            ?: "г. Геленджик,\nул. Лермонтова, 6"
                        )) !!}
                    </li>

                    <li>
                        <a
                            href="tel:{{ preg_replace(
                                '/[^0-9+]/',
                                '',
                                $settings?->phone ?: '+7 (938) 500-01-01'
                            ) }}"
                        >
                            {{ $settings?->phone ?: '+7 (938) 500-01-01' }}
                        </a>
                    </li>

                    <li>
                        <a href="mailto:{{ $settings?->email ?: 'info@hotel-lermont.ru' }}">
                            {{ $settings?->email ?: 'info@hotel-lermont.ru' }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-actions">
                <button
                    class="btn btn-outline-light w-100 mb-3"
                    type="button"
                    
                >
                    Забронировать
                </button>

                @if ($settings?->phone)
                    <a
                        href="https://wa.me/{{ preg_replace('/\D/', '', $settings->phone) }}"
                        class="footer-whatsapp"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Напишите нам в WhatsApp
                    </a>
                @endif
            </div>
        </div>

        <hr class="my-4">

        <div class="footer-bottom d-flex flex-wrap justify-content-between gap-3 small">
            <span>
                © {{ now()->year }}
                {{ $settings?->site_name ?? 'Отель Лермонт' }}.
                Все права защищены.
            </span>

            <span class="d-flex flex-wrap gap-4">
                <a href="{{ url('/privacy-policy') }}">
                    Политика конфиденциальности
                </a>

                <a href="{{ url('/personal-data-consent') }}">
                    Согласие на обработку персональных данных
                </a>
            </span>
        </div>
    </div>
</footer>