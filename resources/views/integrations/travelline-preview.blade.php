<!doctype html>
<html lang="ru"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Проверка TravelLine API — Лермонт</title>
<style>body{margin:0;background:#f6efe5;color:#243a2f;font:16px/1.6 Arial,sans-serif}main{max-width:1050px;margin:40px auto;padding:0 24px}h1,h2{font-family:Georgia,serif}a{color:#69542f}form,.card,.notice{padding:24px;background:white;border:1px solid #ded4c5;border-radius:8px;margin:20px 0}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:16px}label{display:block}input{box-sizing:border-box;width:100%;padding:12px;border:1px solid #bfb7a9;font:inherit}button{padding:12px 20px;background:#243a2f;color:white;border:0;cursor:pointer;font:inherit}small{display:block} .price{font-size:24px} .muted{color:#6c716d}</style></head>
<body><main><a href="/admin/site-settings">← Настройки сайта</a><h1>Поиск номеров без iframe</h1>
<p class="notice">Закрытая проверка для администраторов. Рабочая форма бронирования не изменена. Реальные брони здесь не создаются.</p>
@if(session('tl_check'))<p role="status" class="notice">{{ session('tl_check') }}</p>@endif
@if($apiError)<p role="alert" class="notice">{{ $apiError }}</p>@endif
@if($errors->any())<div role="alert" class="notice">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>@endif
<form method="post" action="{{ route('travelline.check') }}">@csrf<button>Проверить подключение</button><small>API {{ $settings?->travelline_api_enabled ? 'включён для проверки' : 'выключен' }}. ID отеля: {{ $settings?->travelline_hotel_id ?: 'не заполнен' }}.</small></form>
<form method="get" action="{{ route('travelline.preview') }}"><div class="grid">
<label>Заезд<input type="date" name="arrival" required value="{{ request('arrival',now('Europe/Moscow')->addDay()->toDateString()) }}"></label>
<label>Выезд<input type="date" name="departure" required value="{{ request('departure',now('Europe/Moscow')->addDays(2)->toDateString()) }}"></label>
<label>Взрослые<input type="number" name="adults" min="1" max="10" required value="{{ request('adults',2) }}"></label>
<label>Возраст детей<input name="child_ages" value="{{ request('child_ages') }}" placeholder="Например: 3, 7"><small>Через запятую; оставьте пустым, если детей нет.</small></label>
</div><p><button>Найти номера</button></p></form>
@if($result !== null)
<h2>Варианты размещения</h2>
@php($rateNames = collect($content['ratePlans'] ?? [])->keyBy('id'))
@forelse($result['roomStays'] ?? [] as $stay)
@php($localRoom = $localRooms->get($stay['roomType']['id'] ?? ''))
@php($apiRoom = collect($content['roomTypes'] ?? [])->firstWhere('id', $stay['roomType']['id'] ?? ''))
<article class="card"><h3>{{ $localRoom?->name ?: ($apiRoom['name'] ?? 'Категория ' . ($stay['roomType']['id'] ?? '')) }}</h3>
<p>Тариф: {{ $rateNames->get($stay['ratePlan']['id'] ?? '')['name'] ?? ($stay['ratePlan']['id'] ?? 'не указан') }}</p>
<p class="price">{{ isset($stay['total']['priceBeforeTax']) ? number_format($stay['total']['priceBeforeTax'],2,',',' ') : '—' }} {{ $stay['currencyCode'] ?? '' }} <small>за проживание, без сборов к оплате при заселении</small></p>
<p>Сборы при заселении: {{ number_format($stay['total']['taxAmount'] ?? 0,2,',',' ') }} {{ $stay['currencyCode'] ?? '' }}.</p>
<p>Доступно: {{ $stay['availability'] ?? '—' }}. {{ $stay['fullPlacementsName'] ?? '' }}</p>
@if($localRoom)<a href="{{ route('rooms.show',$localRoom) }}">Описание и фотографии номера →</a>@endif
<p class="muted">Оформление появится после проверки Reservation API, правил отмены и оплаты.</p></article>
@empty<p class="notice">На выбранные даты предложений не найдено.</p>@endforelse
@endif
</main></body></html>
