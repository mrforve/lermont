<?php

namespace App\Notifications;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactRequestStatusChanged extends Notification
{
    use Queueable;

    public function __construct(
        private readonly ContactRequest $contactRequest
    ) {
    }

    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Статус обращения изменён',
            'body' => sprintf(
                'Обращение №%d: %s',
                $this->contactRequest->id,
                $this->statusLabel()
            ),
            'contact_request_id' => $this->contactRequest->id,
            'status' => $this->contactRequest->status,
            'url' => route(
                'account.requests.show',
                $this->contactRequest
            ),
        ];
    }

    private function statusLabel(): string
    {
        return match ($this->contactRequest->status) {
            ContactRequest::STATUS_IN_PROGRESS => 'В работе',
            ContactRequest::STATUS_PROCESSED => 'Обработано',
            ContactRequest::STATUS_CANCELLED => 'Отменено',
            default => 'Новое',
        };
    }
}