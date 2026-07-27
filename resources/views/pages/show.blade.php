@extends('layouts.app')

@section('content')
    <article class="page">
        <div class="container">
            <h1>{{ $page->title }}</h1>

            @if ($page->content)
                <div class="page__intro">
                    {!! $page->content !!}
                </div>
            @endif

            @include('pages.partials.blocks', [
                'blocks' => $page->blocks ?? [],
            ])
        </div>
        @include('partials.contact-form', [
            'type' => \App\Models\ContactRequest::TYPE_MESSAGE,
            'title' => 'Оставить сообщение',
        ])

        @include('partials.contact-form', [
            'type' => \App\Models\ContactRequest::TYPE_CALLBACK,
            'title' => 'Заказать обратный звонок',
        ])
    </article>
@endsection