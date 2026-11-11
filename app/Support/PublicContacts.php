<?php
namespace App\Support;
use App\Models\SiteSetting;
class PublicContacts
{
    public static function url(?string $url, bool $local = false): ?string
    {
        $url = trim($url ?? '');
        if ($url === '' || preg_match('/[\x00-\x20]/', $url)) return null;
        if ($local && str_starts_with($url, '/') && !str_starts_with($url, '//') && !str_contains($url, '\\')) return url($url);
        if (!filter_var($url, FILTER_VALIDATE_URL) || !in_array(strtolower(parse_url($url, PHP_URL_SCHEME) ?? ''), ['http','https'], true)) return null;
        return $url;
    }
    public static function phone(?string $phone): ?string
    {
        $number = preg_replace('/[^0-9+]/', '', $phone ?? '');
        return preg_match('/^\+?[0-9]{5,15}$/', $number) ? $number : null;
    }
    public static function email(?string $email): ?string { return filter_var($email, FILTER_VALIDATE_EMAIL) ?: null; }
    public static function links(?SiteSetting $settings): array
    {
        $definitions = [
        ['key'=>'google','field'=>'google_maps_url','label'=>'Google Maps'],
        ['key'=>'yandex','field'=>'yandex_maps_url','label'=>'Яндекс Карты'],
        ['key'=>'2gis','field'=>'gis_maps_url','label'=>'2ГИС'],
        ['key'=>'max','field'=>'max_channel_url','label'=>'Канал в MAX'],
        ['key'=>'ok','field'=>'ok_url','label'=>'Одноклассники'],
        ['key'=>'tripadvisor','field'=>'tripadvisor_url','label'=>'Tripadvisor'],
        ['key'=>'max_chat','field'=>'max_chat_url','label'=>'Написать в MAX'],
        ['key'=>'vk','field'=>'vk_url','label'=>'ВКонтакте'],
        ['key'=>'rutube','field'=>'rutube_url','label'=>'Rutube'],
        ['key'=>'dzen','field'=>'dzen_url','label'=>'Дзен'],
        ['key'=>'telegram','field'=>'telegram_url','label'=>'Telegram'],
        ['key'=>'whatsapp','field'=>'whatsapp_url','label'=>'WhatsApp'],
        ['key'=>'youtube','field'=>'youtube_url','label'=>'YouTube'],
        ];
        $links = [];
        foreach ($definitions as $item) {
            if ($url = self::url($settings?->{$item['field']})) $links[$item['key']] = ['key'=>$item['key'],'label'=>$item['label'],'url'=>$url];
        }
        return $links;
    }
    public static function footerLinks(?array $items): array
    {
        $links = [];
        foreach ($items ?? [] as $item) {
            if (trim($item['label'] ?? '') !== '' && ($url = self::url($item['url'] ?? null, true))) $links[] = ['label'=>$item['label'],'url'=>$url,'new_tab'=>(bool)($item['new_tab'] ?? false)];
        }
        return $links;
    }
}
