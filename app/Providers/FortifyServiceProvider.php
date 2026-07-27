<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request): Limit {
            $email = Str::transliterate(
                Str::lower((string) $request->input('email'))
            );

            return Limit::perMinute(5)
                ->by($email . '|' . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request): Limit {
            return Limit::perMinute(5)
                ->by((string) $request->session()->get('login.id'));
        });

        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::updateUserProfileInformationUsing(
            UpdateUserProfileInformation::class
        );

        Fortify::updateUserPasswordsUsing(
            UpdateUserPassword::class
        );

        Fortify::resetUserPasswordsUsing(
            ResetUserPassword::class
        );

        Fortify::authenticateUsing(function (Request $request): ?User {
            $user = User::query()
                ->where(
                    'email',
                    mb_strtolower((string) $request->input('email'))
                )
                ->first();

            if (
                $user !== null
                && $user->is_active
                && Hash::check(
                    (string) $request->input('password'),
                    $user->password
                )
            ) {
                return $user;
            }

            return null;
        });

        Fortify::loginView(
            fn () => view('auth.login')
        );

        Fortify::registerView(
            fn () => view('auth.register')
        );

        Fortify::requestPasswordResetLinkView(
            fn () => view('auth.forgot-password')
        );

        Fortify::resetPasswordView(
            fn (Request $request) => view('auth.reset-password', [
                'request' => $request,
            ])
        );

        Fortify::verifyEmailView(
            fn () => view('auth.verify-email')
        );

        Fortify::confirmPasswordView(
            fn () => view('auth.confirm-password')
        );
    }
}