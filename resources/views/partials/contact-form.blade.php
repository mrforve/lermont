@php
    $formType = $type ?? \App\Models\ContactRequest::TYPE_CALLBACK;
    $formTitle = $title ?? ($formType === \App\Models\ContactRequest::TYPE_MESSAGE
        ? 'Оставить сообщение'
        : 'Заказать обратный звонок');
@endphp

<section class="contact-form-section">
    <div class="container">
    <div class="contact-form-card">
        <h2>{{ $formTitle }}</h2>

        @if (session('contact_request_status'))
            <div class="form-message form-message--success">
                {{ session('contact_request_status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="form-message form-message--error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('contact-request.store') }}"
            class="contact-form"
        >
            @csrf
            @php $spamChallenge = \App\Support\ContactSpamGuard::challenge(); @endphp
            <input type="hidden" name="spam_token" value="{{ $spamChallenge['token'] }}">


            <input
                type="hidden"
                name="type"
                value="{{ $formType }}"
            >

            <div class="contact-form__honeypot" aria-hidden="true">
                <label>
                    Не заполняйте это поле
                    <input
                        type="text"
                        name="website"
                        value=""
                        tabindex="-1"
                        autocomplete="off"
                    >
                </label>
            </div>

            <label>
                Имя

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', auth()->user()?->name) }}"
                    required
                    maxlength="255"
                    autocomplete="name"
                >
            </label>

            <label>
                Телефон

                <input
                    type="tel"
                    name="phone"
                    value="{{ old('phone', auth()->user()?->phone) }}"
                    maxlength="50"
                    autocomplete="tel"
                >
            </label>

            <label>
                Email

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', auth()->user()?->email) }}"
                    maxlength="255"
                    autocomplete="email"
                >
            </label>

            @if ($formType !== \App\Models\ContactRequest::TYPE_CALLBACK)
                <label>
                    Тема

                    <input
                        type="text"
                        name="subject"
                        value="{{ old('subject') }}"
                        maxlength="255"
                    >
                </label>

                <label class="contact-form__full">
                    Сообщение

                    <textarea
                        name="message"
                        rows="6"
                        maxlength="5000"
                    >{{ old('message') }}</textarea>
                </label>
            @endif

            <label class="contact-form__privacy contact-form__full">
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
                        href="{{ asset('documents/consumer/soglasie-na-obrabotku-personalnyh-dannyh.pdf') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        согласие на обработку персональных данных
                    </a>
                    и ознакомлен с
                    <a
                        href="{{ asset('documents/consumer/politika-konfidencialnosti.pdf') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        политикой конфиденциальности
                    </a>.
                </span>
            </label>

            <label class="contact-form__full">
                Защита от спама: сколько будет {{ $spamChallenge['question'] }}?
                <input type="text" name="spam_answer" inputmode="numeric" pattern="[0-9]{1,2}" maxlength="2" autocomplete="off" required aria-describedby="spam-answer-help-{{ $formType }}">
                <small id="spam-answer-help-{{ $formType }}">Введите ответ цифрами. Это помогает защитить форму от автоматических сообщений.</small>
            </label>

            <div class="contact-form__full">
                <button
                    type="submit"
                    class="button button--primary"
                >
                    Отправить
                </button>
            </div>
        </form>
    </div>
    </div>
</section>