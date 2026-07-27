@php
    $isAboutPage = request()->is('about') || request()->is('about/*');
    $headerModifier = request()->routeIs('home')
        ? 'main-header--home'
        : ($isAboutPage ? 'main-header--about' : 'main-header--inner');

    $hotelPhone = '+7 (928) 241-43-22';
    $hotelPhoneHref = '+79282414322';
@endphp
<nav
    class="navbar main-header {{ $headerModifier }}"
    id="mainNav"
>
    <div class="container main-header__container">
        <a
            class="navbar-brand site-logo"
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

        <div class="header-mobile-actions">
            <a
                href="tel:{{ $hotelPhoneHref }}"
                class="header-mobile-phone"
                aria-label="Позвонить в отель: {{ $hotelPhone }}"
            >
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path
                        d="M7.2 4.4L9.3 4C9.9 3.9 10.5 4.2 10.8 4.8L11.9 7.4C12.1 7.9 12 8.5 11.6 8.9L10.4 10.1C11.4 12 12.9 13.6 14.9 14.6L16.1 13.4C16.5 13 17.1 12.9 17.6 13.1L20.2 14.2C20.8 14.5 21.1 15.1 21 15.7L20.6 17.8C20.4 18.8 19.5 19.5 18.5 19.5C10.8 19.5 4.5 13.2 4.5 5.5C4.5 4.5 5.2 3.6 6.2 3.4Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </a>

            <select class="header-mobile-lang" aria-label="Выбор языка">
                <option value="ru">RU</option>
                <option value="en">EN</option>
            </select>

            <button
                class="header-burger"
                type="button"
                aria-label="Открыть меню"
                aria-expanded="false"
                aria-controls="navbarNav"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="navbar-collapse header-menu" id="navbarNav">
            <ul class="navbar-nav header-menu__nav">
                @foreach ($headerMenu as $item)
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ $item->resolved_url }}"
                            target="{{ $item->target }}"
                        >
                            {{ $item->title }}
                        </a>

                        @if ($item->children->isNotEmpty())
                            <ul class="header-submenu">
                                @foreach ($item->children as $child)
                                    <li>
                                        <a
                                            href="{{ $child->resolved_url }}"
                                            target="{{ $child->target }}"
                                        >
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="header-menu__actions">
                <a
                    href="tel:{{ $hotelPhoneHref }}"
                    class="phone-btn"
                    aria-label="Позвонить в отель: {{ $hotelPhone }}"
                >
                    <svg
                        class="icon icon-phone"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M7.2 4.4L9.3 4C9.9 3.9 10.5 4.2 10.8 4.8L11.9 7.4C12.1 7.9 12 8.5 11.6 8.9L10.4 10.1C11.4 12 12.9 13.6 14.9 14.6L16.1 13.4C16.5 13 17.1 12.9 17.6 13.1L20.2 14.2C20.8 14.5 21.1 15.1 21 15.7L20.6 17.8C20.4 18.8 19.5 19.5 18.5 19.5C10.8 19.5 4.5 13.2 4.5 5.5C4.5 4.5 5.2 3.6 6.2 3.4Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    {{ $hotelPhone }}
                </a>

                <button
                    class="btn btn-gold header-book-btn"
                    type="button"
                    aria-disabled="true"
                >
                    Забронировать
                </button>
            </div>
        </div>
    </div>
</nav>
