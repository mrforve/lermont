@extends('layouts.app')

@section('title', 'Подтверждение пароля')

@section('content')
    <section class="auth-page">
        <div class="container">
            <div class="auth-card">
                <h1>Подтвердите пароль</h1>

                @if ($errors->any())
                    <div class="auth-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <label>
                        Пароль
                        <input
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        >
                    </label>

                    <button type="submit">
                        Подтвердить
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection