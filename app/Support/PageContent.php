<?php
namespace App\Support;
use App\Models\Page;
class PageContent
{
    private static ?array $defaults = null;
    public static function kind(?Page $page): ?string { return $page?->template === 'home' ? 'home' : ($page?->slug === 'breakfast' ? 'breakfast' : null); }
    public static function value(?Page $page, string $key, mixed $fallback = null): mixed
    {
        $data=$page?->visual_content ?? [];
        if (\Illuminate\Support\Arr::has($data,$key)) return data_get($data,$key);
        self::$defaults ??= json_decode(file_get_contents(resource_path('content/page-visual-defaults.json')),true);
        return data_get(self::$defaults,self::kind($page).'.'.$key,$fallback);
    }
    public static function text(?Page $page,string $key): string {return (string)self::value($page,'texts.'.$key,'');}
    public static function visible(?Page $page,string $key): bool {return (bool)self::value($page,'sections.'.$key,true);}
    public static function link(?Page $page,string $key): string
    {
        $value=(string)self::value($page,'links.'.$key,'');
        if(preg_match('/^#[a-zA-Z][a-zA-Z0-9_-]*$/',$value))return $value;
        return PublicContacts::url($value,true) ?? '#';
    }
    public static function media(?Page $page,string $key,?int $width=null): string
    {
        $data=self::value($page,'media.'.$key,[]);
        $upload=$data['upload']??null;if(is_array($upload))$upload=reset($upload);
        $url=$upload ? asset('storage/'.ltrim($upload,'/')) : PublicContacts::url($data['source']??null,true);
        if(!$url)return '';
        $url=str_replace(["'",'"','<','>'],['%27','%22','%3C','%3E'],$url);
        return $width ? ResponsiveImage::url($url,$width) : $url;
    }
}
