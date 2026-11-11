<?php
namespace App\Filament\Resources\Pages\Schemas;
use App\Models\Page;
use App\Support\PageContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
class PageVisualContentForm
{
    public static function components(): array
    {
        $schema=json_decode(file_get_contents(resource_path('content/page-visual-schema.json')),true);$sections=[Section::make('Редактирование готовых блоков')->description('Раскройте нужную секцию ниже. На главной первый экран (заголовок, описание и фон, в том числе мобильный) редактируется в разделе «Слайды»; карточки номеров — в «Типах номеров»; предложения — в «Акциях». SEO-текст и FAQ — в контентных блоках страницы.')->schema([])->columnSpanFull()->visible(fn(?Page $record)=>PageContent::kind($record)!==null)];
        foreach($schema as $kind=>$groups){foreach($groups as $key=>$group){
            $fields=[Toggle::make('visual_content.sections.'.$key)->label('Показывать блок')->default(true)];
            foreach($group['fields'] as $field){$path='visual_content.';
                if($field['type']==='text'){
                    $fields[]=Textarea::make($path.'texts.'.$field['key'])->label($field['label'])->rows(2)->maxLength(10000)->helperText('Переносы строк сохраняются. HTML вводить не нужно.')->columnSpanFull();
                }elseif($field['type']==='link'){
                    $fields[]=TextInput::make($path.'links.'.$field['key'])->label($field['label'])->maxLength(2048)->rules(['nullable','regex:~^(?:#[a-zA-Z][a-zA-Z0-9_-]*|/(?!/)[^\\s]*|https?://[^\\s]+)$~i']);
                }else{
                    $video=$field['type']==='video';
                    $fields[]=Section::make($field['label'])->schema([
                        TextInput::make($path.'media.'.$field['key'].'.source')->label('Текущий файл или URL')->maxLength(2048)->helperText('Путь /img/… или полный HTTPS-адрес. Загруженный файл имеет приоритет.'),
                        FileUpload::make($path.'media.'.$field['key'].'.upload')->label($video?'Загрузить видео':'Загрузить изображение')->disk('public')->directory('pages/visuals')->visibility('public')
                            ->acceptedFileTypes($video?['video/mp4','video/webm']:['image/jpeg','image/png','image/webp','image/avif'])
                            ->maxSize($video?102400:10240)->helperText($video?'MP4/WebM, до 100 МБ. Для более крупного файла укажите URL.':'JPG, PNG, WebP или AVIF, до 10 МБ.')->columnSpanFull(),
                    ])->columns(1)->columnSpanFull();
                }
            }
            $sections[]=Section::make(($kind==='home'?'Главная':'Завтраки').' · '.$group['label'])->schema($fields)->columns(2)->collapsible()->collapsed()->columnSpanFull()
                ->visible(fn(?Page $record)=>PageContent::kind($record)===$kind);
        }}
        return $sections;
    }
}
