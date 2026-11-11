@if(\App\Support\PageContent::visible($page, 'reviews'))
<section class="home-reviews" aria-labelledby="home-reviews-title">
    <div class="container">
        <div class="home-reviews__heading">
            <div>
                <h2 id="home-reviews-title">{!! nl2br(e(\App\Support\PageContent::text($page, 'reviews_text_4'))) !!}</h2>
                <p>{!! nl2br(e(\App\Support\PageContent::text($page, 'reviews_text_6'))) !!}</p>
            </div>
            <a class="home-reviews__link" href="{{ route('reviews') }}">{!! nl2br(e(\App\Support\PageContent::text($page, 'reviews_text_9'))) !!}</a>
        </div>
        <details class="home-reviews__preview">
            <summary>{!! nl2br(e(\App\Support\PageContent::text($page, 'reviews_text_13'))) !!}</summary>
            <iframe data-lazy-src="https://yandex.ru/maps-reviews-widget/1197698407?comments" title="Отзывы гостей об отеле Лермонт на Яндекс Картах" width="750" height="500" loading="lazy"></iframe>
            <p><a href="https://yandex.ru/maps/org/lermont/1197698407/reviews/" target="_blank" rel="noopener noreferrer">{!! nl2br(e(\App\Support\PageContent::text($page, 'reviews_text_16'))) !!}</a></p>
        </details>
    </div>
</section>

@endif
