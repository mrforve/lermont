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
                @if ($settings?->footer_text)<p class="mt-3 mb-3">{!! nl2br(e($settings->footer_text)) !!}</p>@endif
                @include('partials.external-links', ['includeMaps' => true])
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="h6 footer-title">Информация</div>
                <ul class="list-unstyled mb-0">
                    @foreach ($footerMenu as $item)
                        @php($href = \App\Support\PublicContacts::url($item->resolved_url, true))
                        @continue(!$href)
                        <li><a href="{{ $href }}" @if($item->target === '_blank') target="_blank" rel="noopener noreferrer" @endif>{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="h6 footer-title">Контакты</div>
                <ul class="list-unstyled mb-0 footer-contacts">
                    @if($settings?->address)<li>{!! nl2br(e($settings->address)) !!}</li>@endif
                    @foreach (['phone','phone_secondary'] as $field)
                        @if($phoneHref = \App\Support\PublicContacts::phone($settings?->{$field}))<li><a href="tel:{{ $phoneHref }}">{{ $settings->{$field} }}</a></li>@endif
                    @endforeach
                    @if($email = \App\Support\PublicContacts::email($settings?->email))<li><a href="mailto:{{ $email }}">{{ $email }}</a></li>@endif
                    @if($settings?->working_hours)<li>{{ $settings->working_hours }}</li>@endif
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
                @foreach ($footerLegalMenu as $item)
                    @php($href = \App\Support\PublicContacts::url($item->resolved_url, true))
                    @continue(!$href)
                    <a href="{{ $href }}" @if($item->target === '_blank') target="_blank" rel="noopener noreferrer" @endif>{{ $item->title }}</a>
                @endforeach
            </span>
        </div>
    </div>
</footer>
