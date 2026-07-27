@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <section class="auth-page">
        <div class="container">
            <div class="auth-card">
                <h1>Восстановление пароля</h1>

                @if (session('status'))
                    <div class="auth-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
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

                    <button type="submit">
                        Отправить ссылку
                    </button>
                </form>

                <a href="{{ route('login') }}">
                    Вернуться ко входу
                </a>
            </div>
        </div>
    </section>
@endsection