@extends('layouts.app')

@section('title', 'Номера')

@section('content') 
<section class="rooms-catalog"> 
    <div class="container"> <header class="rooms-catalog__header">
        <div>
            <span class="rooms-catalog__eyebrow">
                Отель «Лермонт»
            </span>
            ```
            <h1>Номера</h1>
        </div>

            <p class="rooms-catalog__intro">
                Выберите подходящую категорию номера для комфортного отдыха
                в центре Геленджика.
            </p>
        </header>

        <div id='block-search-inner'>
            <div id='tl-search-form-inner' class='tl-container'>
                <noindex><a href='http://www.travelline.ru/products/tl-hotel' rel='nofollow'>система онлайн-бронирования</a></noindex>
            </div>
        </div>
        <script type='text/javascript'>
            (function(w) {
                var q = [
                    ['setContext', 'TL-INT-hotel-lermont-new', 'ru'],
                    ['embed', 'search-form', {
                        container: 'tl-search-form-inner'
                    }]
                ];
                var t = w.travelline = (w.travelline || {}),
                    ti = t.integration = (t.integration || {});
                ti.__cq = ti.__cq ? ti.__cq.concat(q) : q;
                if (!ti.__loader) {
                    ti.__loader = true;
                    var d = w.document,
                        p = d.location.protocol,
                        s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = (p == 'https:' ? p : 'http:') + '//ibe.tlintegration.com/integration/loader.js';
                    (d.getElementsByTagName('head')[0] || d.getElementsByTagName('body')[0]).appendChild(s);
                }
            })(window);
            (function () {
                document.addEventListener('DOMContentLoaded', function () {
                    var elem = document.querySelector('#tl-search-form-inner');
                    var elemTop = elem.getBoundingClientRect().top + window.pageYOffset;
                    function scrollFix() {
                        if ((elemTop <= window.pageYOffset) && (document.documentElement.offsetWidth >= 1199)) {
                            elem.classList.add('fixed')
                        } else {
                            elem.classList.remove('fixed')
                        }
                    }
                    scrollFix();
                    window.addEventListener('scroll', scrollFix);
                });
            })();
        </script>
    </div>
</section>
```

@endsection
