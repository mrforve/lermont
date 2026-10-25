@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<section class="travelline-page">
    <div class="container">
        <div class="travelline-page__heading">
            <span class="travelline-page__eyebrow">ЛЕРМОНТ —</span>
            <h1>Личный кабинет гостя</h1>
            <p>Управляйте бронированиями и данными участника программы лояльности.</p>
        </div>

        <div id="tl-guest-account" class="tl-container travelline-widget">
            <noscript>
                Для входа в личный кабинет включите JavaScript в браузере.
            </noscript>
        </div>
    </div>
</section>
@endsection
