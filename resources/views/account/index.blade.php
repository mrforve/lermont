@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <section class="account-page">
        <div class="container">
            <div class="account-header">
                <div>
                    <h1>Личный кабинет</h1>

                    <p>
                        {{ $user->last_name }}
                        {{ $user->name }}
                        {{ $user->middle_name }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="button button--outline">
                        Выйти
                    </button>
                </form>
            </div>

            @if (session('profile_status'))
                <div class="account-message account-message--success">
                    {{ session('profile_status') }}
                </div>
            @endif

            @if (session('password_status'))
                <div class="account-message account-message--success">
                    {{ session('password_status') }}
                </div>
            @endif

            <div class="account-grid">
                <section class="account-card">
                    <h2>Личные данные</h2>

                    <form
                        method="POST"
                        action="{{ route('account.profile.update') }}"
                        class="account-form"
                    >
                        @csrf
                        @method('PATCH')

                        <label>
                            Фамилия

                            <input
                                type="text"
                                name="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                required
                            >

                            @error('last_name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Имя

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                            >

                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Отчество

                            <input
                                type="text"
                                name="middle_name"
                                value="{{ old('middle_name', $user->middle_name) }}"
                            >

                            @error('middle_name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Телефон

                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                required
                            >

                            @error('phone')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Email

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                            >

                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <button type="submit" class="button button--primary">
                            Сохранить профиль
                        </button>
                    </form>
                </section>

                <section class="account-card">
                    <h2>Смена пароля</h2>

                    <form
                        method="POST"
                        action="{{ route('account.password.update') }}"
                        class="account-form"
                    >
                        @csrf
                        @method('PATCH')

                        <label>
                            Текущий пароль

                            <input
                                type="password"
                                name="current_password"
                                required
                                autocomplete="current-password"
                            >

                            @error('current_password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Новый пароль

                            <input
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                            >

                            @error('password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Повторите новый пароль

                            <input
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                            >
                        </label>

                        <button type="submit" class="button button--primary">
                            Изменить пароль
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </section>

    <section class="account-card account-card--notifications">
        <div class="account-card__header">
            <h2>
                Уведомления

                @if ($unreadNotificationsCount > 0)
                    <span class="account-badge">
                        {{ $unreadNotificationsCount }}
                    </span>
                @endif
            </h2>

            @if ($unreadNotificationsCount > 0)
                <form
                    method="POST"
                    action="{{ route('account.notifications.read-all') }}"
                >
                    @csrf

                    <button type="submit" class="button button--outline">
                        Прочитать все
                    </button>
                </form>
            @endif
        </div>

        @if (session('notifications_status'))
            <div class="account-message account-message--success">
                {{ session('notifications_status') }}
            </div>
        @endif

        @if ($notifications->isEmpty())
            <p>Уведомлений пока нет.</p>
        @else
            <div class="account-notifications">
                @foreach ($notifications as $notification)
                    <a
                        href="{{ route(
                            'account.notifications.read',
                            $notification->id
                        ) }}"
                        class="account-notification
                            {{ $notification->read_at === null
                                ? 'account-notification--unread'
                                : ''
                            }}"
                    >
                        <div>
                            <strong>
                                {{ $notification->data['title'] ?? 'Уведомление' }}
                            </strong>

                            <p>
                                {{ $notification->data['body'] ?? '' }}
                            </p>
                        </div>

                        <time datetime="{{ $notification->created_at->toAtomString() }}">
                            {{ $notification->created_at->format('d.m.Y H:i') }}
                        </time>
                    </a>
                @endforeach
            </div>

            {{ $notifications->links() }}
        @endif
    </section>

    <section class="account-card account-card--requests">
        <h2>Мои обращения</h2>

        @if ($contactRequests->isEmpty())
            <p>Вы ещё не отправляли обращений.</p>
        @else
            <div class="account-requests">
                @foreach ($contactRequests as $contactRequest)
                    <a
                        href="{{ route('account.requests.show', $contactRequest) }}"
                        class="account-request"
                    >
                        <div>
                            <strong>
                                @switch($contactRequest->type)
                                    @case(\App\Models\ContactRequest::TYPE_CALLBACK)
                                        Обратный звонок
                                        @break

                                    @case(\App\Models\ContactRequest::TYPE_QUESTION)
                                        Вопрос
                                        @break

                                    @default
                                        Сообщение
                                @endswitch
                            </strong>

                            <span>
                                {{ $contactRequest->created_at->format('d.m.Y H:i') }}
                            </span>
                        </div>

                        <span class="account-request__status">
                            @switch($contactRequest->status)
                                @case(\App\Models\ContactRequest::STATUS_IN_PROGRESS)
                                    В работе
                                    @break

                                @case(\App\Models\ContactRequest::STATUS_PROCESSED)
                                    Обработана
                                    @break

                                @case(\App\Models\ContactRequest::STATUS_CANCELLED)
                                    Отменена
                                    @break

                                @default
                                    Новая
                            @endswitch
                        </span>
                    </a>
                @endforeach
            </div>

            {{ $contactRequests->links() }}
        @endif
    </section>
@endsection