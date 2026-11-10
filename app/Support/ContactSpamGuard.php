<?php
namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactSpamGuard
{
    public static function challenge(): array
    {
        $a = random_int(2, 9); $b = random_int(2, 9);
        return ['question' => "$a + $b", 'token' => Crypt::encryptString(json_encode([
            'answer' => $a + $b, 'issued' => time(), 'nonce' => bin2hex(random_bytes(16)),
        ], JSON_THROW_ON_ERROR))];
    }

    private static function reject(string $message): never
    {
        throw ValidationException::withMessages(['spam_answer' => $message]);
    }

    public static function check(Request $request, array $validated): void
    {
        $key = 'contact-attempt:' . hash_hmac('sha256', (string) $request->ip(), config('app.key'));
        if (RateLimiter::tooManyAttempts($key, 6)) self::reject('Слишком много попыток. Попробуйте через 10 минут или позвоните в отель.');
        RateLimiter::hit($key, 600);
        try {
            $payload = json_decode(Crypt::decryptString((string) $request->input('spam_token')), true, 8, JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            self::reject('Обновите страницу и ответьте на вопрос защиты от спама.');
        }
        $age = time() - ($payload['issued'] ?? 0);
        if ($age < 3 || $age > 7200 || !preg_match('/\A[a-f0-9]{32}\z/', $payload['nonce'] ?? '')) self::reject('Обновите страницу, заполните форму и повторите отправку.');
        $answer = (string) $request->input('spam_answer');
        if (!preg_match('/\A\d{1,2}\z/', $answer) || (int) $answer !== ($payload['answer'] ?? null)) self::reject('Проверьте ответ на вопрос защиты от спама.');
        $name = trim($validated['name']);
        if (mb_strlen($name) < 2 || !preg_match('/\p{L}/u', $name) || preg_match('~https?://|www\.|[<>\r\n]~iu', $name)) self::reject('Укажите настоящее имя без ссылок.');
        $phone = preg_replace('/\D+/', '', $validated['phone'] ?? '');
        if ($phone !== '' && (strlen($phone) < 10 || strlen($phone) > 15)) self::reject('Укажите телефон с кодом страны или оставьте email.');
        if (preg_match_all('~https?://|www\.~iu', ($validated['message'] ?? '') . ' ' . ($validated['subject'] ?? '')) > 2) self::reject('В сообщении слишком много ссылок. Свяжитесь с отелем по телефону.');
        if (!Cache::add('contact-nonce:' . $payload['nonce'], true, 7200)) self::reject('Эта форма уже отправлена. Для нового обращения обновите страницу.');
        $contact = $phone ?: mb_strtolower($validated['email'] ?? '');
        $fingerprint = hash_hmac('sha256', $contact, config('app.key'));
        if (!Cache::add('contact-recent:' . $fingerprint, true, 600)) self::reject('Обращение с этим контактом уже отправлено. Повторите через 10 минут или позвоните в отель.');
    }
}
