@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <section class="auth-page">
        <div class="container">
            <h1>Регистрация</h1>

            @if ($errors->any())
                <div class="auth-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label>
                    Фамилия
                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        required
                        autocomplete="family-name"
                    >
                </label>

                <label>
                    Имя
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="given-name"
                    >
                </label>

                <label>
                    Отчество
                    <input
                        type="text"
                        name="middle_name"
                        value="{{ old('middle_name') }}"
                        autocomplete="additional-name"
                    >
                </label>

                <label>
                    Телефон
                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        autocomplete="tel"
                    >
                </label>

                <label>
                    Email
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                </label>

                <label>
                    Пароль
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    >
                </label>

                <label>
                    Повторите пароль
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                </label>

                <label class="auth-form__consent">
                    <input
                        type="checkbox"
                        name="privacy_accepted"
                        value="1"
                        required
                        @checked(old('privacy_accepted'))
                    >

                    <span>
                        Я принимаю
                        <a
                            href="{{ url('/personal-data-consent') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            согласие на обработку персональных данных
                        </a>
                        и ознакомлен с
                        <a
                            href="{{ url('/privacy-policy') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            политикой конфиденциальности
                        </a>.
                    </span>
                </label>

                <button type="submit">
                    Зарегистрироваться
                </button>
            </form>

            <a href="{{ route('login') }}">
                Уже есть аккаунт
            </a>
        </div>
    </section>
@endsection