<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('account.index', [
            'user' => $user,

            'contactRequests' => $user
                ->contactRequests()
                ->paginate(10, ['*'], 'requests_page'),

            'notifications' => $user
                ->notifications()
                ->latest()
                ->paginate(10, ['*'], 'notifications_page'),

            'unreadNotificationsCount' => $user
                ->unreadNotifications()
                ->count(),
        ]);
    }

    public function showRequest(
        Request $request,
        ContactRequest $contactRequest
    ): View {
        abort_unless(
            $contactRequest->user_id === $request->user()->id,
            404
        );

        return view('account.contact-request', [
            'user' => $request->user(),
            'contactRequest' => $contactRequest,
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'middle_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:50',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $newEmail = mb_strtolower($validated['email']);
        $emailChanged = $newEmail !== $user->email;

        $user->update([
            'last_name' => $validated['last_name'],
            'name' => $validated['name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'phone' => $validated['phone'],
            'email' => $newEmail,
            'email_verified_at' => $emailChanged
                ? null
                : $user->email_verified_at,
        ]);

        if ($emailChanged) {
            $user->sendEmailVerificationNotification();
        }

        return back()->with(
            'profile_status',
            $emailChanged
                ? 'Профиль сохранён. На новый email отправлено письмо подтверждения.'
                : 'Профиль сохранён.'
        );
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = $request->user();

        if (! Hash::check(
            $validated['current_password'],
            $user->password
        )) {
            return back()
                ->withErrors([
                    'current_password' => 'Текущий пароль указан неверно.',
                ])
                ->withInput();
        }

        $user->update([
            'password' => $validated['password'],
        ]);

        return back()->with(
            'password_status',
            'Пароль успешно изменён.'
        );
    }
    public function markNotificationAsRead(
        Request $request,
        string $notification
    ): RedirectResponse {
        $record = $request->user()
            ->notifications()
            ->whereKey($notification)
            ->firstOrFail();

        $record->markAsRead();

        $url = $record->data['url'] ?? route('account.index');

        return redirect()->to($url);
    }

    public function markAllNotificationsAsRead(
        Request $request
    ): RedirectResponse {
        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with(
            'notifications_status',
            'Все уведомления отмечены как прочитанные.'
        );
    }
}