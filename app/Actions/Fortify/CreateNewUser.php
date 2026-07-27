<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * @param array<string, string> $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
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
                Rule::unique(User::class),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'privacy_accepted' => [
                    'required',
                    'accepted',
                ],
            ], [
                'privacy_accepted.required' =>
                    'Необходимо принять согласие на обработку персональных данных.',

                'privacy_accepted.accepted' =>
                    'Необходимо принять согласие на обработку персональных данных.',
        ])->validate();

        return User::create([
            'last_name' => $input['last_name'],
            'name' => $input['name'],
            'middle_name' => $input['middle_name'] ?? null,
            'phone' => $input['phone'],
            'email' => mb_strtolower($input['email']),
            'password' => $input['password'],
            'is_active' => true,
            'consent_at' => now(),
            'consent_text_version' => '2026-07-14',
        ]);
    }
}