@if (request()->routeIs('home'))
    <div class="travelline-sticky-search" data-travelline-sticky aria-hidden="true" inert>
        <div class="container"><div id="tl-search-form-sticky" class="tl-container"></div></div>
    </div>
@elseif (! request()->routeIs('booking', 'login', 'register', 'password.*', 'verification.*', 'account.*'))
    <section class="travelline-inner-search" aria-label="Поиск номеров">
        <div class="container">
            <div id="tl-search-form-inner" class="tl-container">
                <noscript><a href="{{ route('booking') }}">Перейти к бронированию</a></noscript>
            </div>
        </div>
    </section>
@endif
