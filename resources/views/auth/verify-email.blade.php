@extends('layouts.app')

@section('title', 'Подтверждение email')

@section('content')
    <section class="auth-page">
        <div class="container">
            <div class="auth-card">
                <h1>Подтвердите email</h1>

                <p>
                    Мы отправили письмо со ссылкой для подтверждения на адрес
                    <strong>{{ auth()->user()->email }}</strong>.
                </p>

                @if (session('status') === 'verification-link-sent')
                    <div class="auth-success">
                        Новая ссылка подтверждения отправлена.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit">
                        Отправить письмо повторно
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        Выйти
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection