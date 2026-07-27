@extends('layouts.app')

@section('title', 'Новый пароль')

@section('content')
    <section class="auth-page">
        <div class="container">
            <div class="auth-card">
                <h1>Установить новый пароль</h1>

                @if ($errors->any())
                    <div class="auth-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >

                    <label>
                        Email
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $request->email) }}"
                            required
                            autocomplete="email"
                        >
                    </label>

                    <label>
                        Новый пароль
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

                    <button type="submit">
                        Сохранить пароль
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection