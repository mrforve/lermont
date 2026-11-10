@extends('layouts.app')

@section('title', 'Бронирование номеров в отеле «Лермонт» — официальный сайт')
@section('description', 'Забронируйте номер в отеле «Лермонт» в Геленджике на официальном сайте. Выберите даты поездки, категорию номера и доступный тариф в форме онлайн-бронирования.')

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
