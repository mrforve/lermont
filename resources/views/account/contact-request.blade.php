@extends('layouts.app')

@section('title', 'Обращение №' . $contactRequest->id)

@section('content')
    <section class="account-page">
        <div class="container">
            <a href="{{ route('account.index') }}">
                ← Вернуться в личный кабинет
            </a>

            <section class="account-card account-request-details">
                <h1>Обращение №{{ $contactRequest->id }}</h1>

                <dl>
                    <dt>Дата</dt>
                    <dd>
                        {{ $contactRequest->created_at->format('d.m.Y H:i') }}
                    </dd>

                    <dt>Тип</dt>
                    <dd>
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
                    </dd>

                    <dt>Статус</dt>
                    <dd>
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
                    </dd>

                    <dt>Тема</dt>
                    <dd>{{ $contactRequest->subject ?: '—' }}</dd>

                    <dt>Сообщение</dt>
                    <dd>{!! nl2br(e($contactRequest->message ?: '—')) !!}</dd>

                    @if ($contactRequest->admin_comment)
                        <dt>Ответ администратора</dt>
                        <dd>
                            {!! nl2br(e($contactRequest->admin_comment)) !!}
                        </dd>
                    @endif
                </dl>
            </section>
        </div>
    </section>
@endsection