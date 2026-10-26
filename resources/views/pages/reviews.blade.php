@extends('layouts.app')

@section('title', 'Отзывы об отеле «Лермонт»')

@section('content')
<section class="travelline-page">
    <div class="container">
        <div class="travelline-page__heading">
            <span class="travelline-page__eyebrow">ЛЕРМОНТ —</span>
            <h1>Отзывы об отеле</h1>
        </div>
        <div id="tl-reviews-widget" class="tl-container travelline-widget">
            <noscript>Для просмотра отзывов включите JavaScript в браузере.</noscript>
        </div>
    </div>
</section>
@endsection
