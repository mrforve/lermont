@extends('layouts.app')

@section('title', 'Отзывы об отеле «Лермонт»')

@section('content')
<section class="travelline-page">
    <div class="container">
        <div class="travelline-page__heading">
            <span class="travelline-page__eyebrow">ЛЕРМОНТ —</span>
            <h1>Отзывы об отеле</h1>
        </div>
        <div class="mb-4" style="width:100%;height:600px;max-width:750px;margin:auto;overflow:hidden;position:relative;"><iframe title="Отзывы об отеле Лермонт на Яндекс Картах" style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/1197698407?comments"></iframe><a href="https://yandex.ru/maps/org/lermont/1197698407/" target="_blank" rel="noopener noreferrer" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">Лермонт на карте Геленджика — Яндекс Карты</a></div>
        <div id="tl-reviews-widget" class="tl-container travelline-widget">
            <noscript>Для просмотра отзывов включите JavaScript в браузере.</noscript>
        </div>
    </div>
</section>
@endsection
