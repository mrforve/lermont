Новая заявка с hotel-lermont.ru

Номер: {{ $contactRequest->id }}
Имя: {{ $contactRequest->name }}
Телефон: {{ $contactRequest->phone ?: 'не указан' }}
Email: {{ $contactRequest->email ?: 'не указан' }}
Тема: {{ $contactRequest->subject ?: 'Обратный звонок / обращение с сайта' }}

Сообщение:
{{ $contactRequest->message ?: 'не указано' }}

Открыть заявку в админке:
https://hotel-lermont.ru/admin/contact-requests/{{ $contactRequest->id }}/edit

Это автоматическое уведомление. Письмо содержит контактные данные гостя.
