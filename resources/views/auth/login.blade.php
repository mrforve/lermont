@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <section class="auth-page">
        <div class="container">
            <h1>Вход в личный кабинет</h1>

            @if ($errors->any())
                <div class="auth-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>
                    Email
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                    >
                </label>

                <label>
                    Пароль
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                </label>

                <label>
                    <input type="checkbox" name="remember">
                    Запомнить меня
                </label>

                <button type="submit">
                    Войти
                </button>
            </form>

            <a href="{{ route('password.request') }}">
                Забыли пароль?
            </a>

            <a href="{{ route('register') }}">
                Регистрация
            </a>
        </div>
    </section>
@endsection