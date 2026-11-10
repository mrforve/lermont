<?php
namespace App\Services\TravelLine;
class TravelLineException extends \RuntimeException
{
    public function __construct(public string $reason, public int $httpStatus = 0, public int $retryAfter = 0)
    {
        $messages = [
            'disabled'=>'API TravelLine выключен в настройках.',
            'credentials'=>'Заполните данные подключения TravelLine в админке.',
            'property'=>'Укажите ID отеля TravelLine.',
            'oauth_required'=>'Reservation API требует OAuth: client_id и client_secret.',
            'auth'=>'TravelLine отклонил данные авторизации.',
            'forbidden'=>'Нет доступа к этому API. Проверьте разрешения подключения в TravelLine.',
            'limit'=>'Достигнут лимит запросов TravelLine. Повторите проверку позже.',
            'connection'=>'TravelLine временно недоступен. Повторите проверку позже.',
            'response'=>'TravelLine вернул некорректный ответ.',
            'upstream'=>'TravelLine не выполнил запрос.',
            'writes_disabled'=>'Создание реальных броней заблокировано до проверки оформления и оплаты.',
        ];
        parent::__construct($messages[$reason] ?? $messages['upstream']);
    }
}
