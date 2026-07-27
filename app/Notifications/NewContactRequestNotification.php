<?php

namespace App\Notifications;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContactRequestNotification extends Notification
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
            'format' => 'filament',
            'title' => 'Новая заявка с сайта',
            'body' => $this->getBody(),
            'icon' => 'heroicon-o-inbox',
            'iconColor' => 'danger',
            'status' => 'danger',
            'duration' => 'persistent',
            'actions' => [
                [
                    'name' => 'open',
                    'label' => 'Открыть заявку',
                    'url' => route(
                        'filament.admin.resources.contact-requests.edit',
                        [
                            'record' => $this->contactRequest->id,
                        ]
                    ),
                    'markAsRead' => true,
                ],
            ],
            'contact_request_id' => $this->contactRequest->id,
        ];
    }

    private function getBody(): string
    {
        $contact = $this->contactRequest->phone
            ?: $this->contactRequest->email
            ?: 'Контакт не указан';

        return $this->contactRequest->name . ': ' . $contact;
    }
}