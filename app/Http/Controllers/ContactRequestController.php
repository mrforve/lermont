<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Notifications\NewContactRequestNotification;
use Illuminate\Support\Facades\Notification;

class ContactRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in([
                    ContactRequest::TYPE_MESSAGE,
                    ContactRequest::TYPE_CALLBACK,
                    ContactRequest::TYPE_QUESTION,
                ]),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
                'required_without:email',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'required_without:phone',
            ],

            'subject' => [
                'nullable',
                'string',
                'max:255',
            ],

            'message' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'privacy_accepted' => [
                'accepted',
            ],

            'website' => [
                'nullable',
                'max:0',
            ],
        ], [
            'name.required' => 'Укажите имя.',
            'phone.required_without' => 'Укажите телефон или email.',
            'email.required_without' => 'Укажите email или телефон.',
            'email.email' => 'Укажите корректный email.',
            'privacy_accepted.accepted' => 'Необходимо согласие на обработку персональных данных.',
            'website.max' => 'Ошибка отправки формы.',
        ]);

        $contactRequest = ContactRequest::create([
            'user_id' => $request->user()?->id,
            'type' => $validated['type'],
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'email' => isset($validated['email'])
                ? mb_strtolower($validated['email'])
                : null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => ContactRequest::STATUS_NEW,
            'source_url' => $request->headers->get('referer'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'consent_at' => now(),
            'consent_text_version' => '2026-07-14',
        ]);

        $admins = Admin::query()
            ->where('is_active', true)
            ->whereIn('role', [
                Admin::ROLE_SUPER_ADMIN,
                Admin::ROLE_MANAGER,
            ])
            ->get();

        Notification::send(
            $admins,
            new NewContactRequestNotification($contactRequest)
        );

        return back()->with(
            'contact_request_status',
            'Заявка отправлена. Мы свяжемся с вами.'
        );
    }
}