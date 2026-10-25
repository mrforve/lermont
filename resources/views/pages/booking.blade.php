@extends('layouts.app')

@section('title', 'Бронирование')

@section('content')
<section class="travelline-page">
    <div class="container">
        <div class="travelline-page__heading">
            <span class="travelline-page__eyebrow">ЛЕРМОНТ —</span>
            <h1>Бронирование номеров</h1>
            <p>Выберите даты, категорию номера и подходящий тариф.</p>
        </div>

        <div id="tl-booking-form" class="tl-container travelline-widget">
            <noscript>
                Для бронирования включите JavaScript в браузере.
            </noscript>
        </div>
    </div>
</section>
@endsection
