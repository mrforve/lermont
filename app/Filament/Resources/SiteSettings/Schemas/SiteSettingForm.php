<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основные настройки')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Название сайта')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('working_hours')
                            ->label('Время работы')
                            ->placeholder('Ежедневно, круглосуточно')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Логотип и иконки')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Основной логотип')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->imageEditor(),

                        FileUpload::make('logo_dark')
                            ->label('Логотип для тёмного фона')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->imageEditor(),

                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                    ])
                    ->columns(3),

                Section::make('Контакты')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Основной телефон')
                            ->tel()
                            ->maxLength(50),

                        TextInput::make('phone_secondary')
                            ->label('Дополнительный телефон')
                            ->tel()
                            ->maxLength(50),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Адрес')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Социальные сети')
                    ->schema([
                        TextInput::make('telegram_url')
                            ->label('Telegram')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('whatsapp_url')
                            ->label('WhatsApp')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('vk_url')
                            ->label('ВКонтакте')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Уведомления MAX')
                    ->description('Дублирование новых заявок в закрытый канал или чат. Email продолжает работать независимо.')
                    ->schema([
                        TextInput::make('max_bot_token')
                            ->label('Токен бота MAX')
                            ->password()->autocomplete('new-password')
                            ->maxLength(512)
                            ->placeholder(fn ($record) => $record?->getRawOriginal('max_bot_token') ? 'Токен сохранён. Оставьте пустым, чтобы сохранить текущий.' : 'Вставьте токен бота')
                            ->afterStateHydrated(fn ($component) => $component->state(null))
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Хранится в БД в зашифрованном виде. Для замены вставьте новый токен.'),
                        TextInput::make('max_chat_id')
                            ->label('ID канала / чата MAX')
                            ->rules(['nullable', 'regex:/^-?[0-9]+$/'])
                            ->maxLength(30)
                            ->helperText('Числовой chat_id, полученный через API. Ссылка-приглашение сюда не подходит.'),
                        \Filament\Forms\Components\Toggle::make('max_notifications_enabled')
                            ->label('Дублировать новые заявки в MAX')
                            ->default(false)
                            ->helperText('Бот должен быть администратором канала с правом публикации.'),
                    ])->columns(2)->columnSpanFull(),

                Section::make('TravelLine')
                    ->description('Серверное API-подключение. До проверки полного цикла бронирования посетители продолжают использовать действующий модуль.')
                    ->schema([
                        \Filament\Forms\Components\Toggle::make('travelline_api_enabled')
                            ->label('Включить API для закрытой проверки')
                            ->helperText('Не заменяет рабочее бронирование на сайте.')->default(false),
                        \Filament\Forms\Components\Select::make('travelline_auth_mode')
                            ->label('Авторизация API')
                            ->options(['oauth'=>'OAuth 2.0: client_id + client_secret', 'api_key'=>'X-API-KEY: только Content/Search'])
                            ->default('oauth')->required(),
                        TextInput::make('travelline_client_id')
                            ->label('Client ID')->maxLength(255),
                        TextInput::make('travelline_client_secret')
                            ->label('Client secret')->password()->autocomplete('new-password')->maxLength(2048)
                            ->placeholder(fn ($record) => $record?->getRawOriginal('travelline_client_secret') ? 'Сохранён. Пустое поле сохраняет текущий секрет.' : 'Введите client_secret')
                            ->afterStateHydrated(fn ($component) => $component->state(null))
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Хранится в БД зашифрованным; в браузер не возвращается.'),
                        TextInput::make('travelline_api_key')
                            ->label('API key (если выдан вместо OAuth)')->password()->autocomplete('new-password')->maxLength(2048)
                            ->placeholder(fn ($record) => $record?->getRawOriginal('travelline_api_key') ? 'Ключ сохранён.' : 'Не требуется для OAuth')
                            ->afterStateHydrated(fn ($component) => $component->state(null))
                            ->dehydrated(fn ($state) => filled($state)),
                        TextInput::make('travelline_hotel_id')
                            ->label('ID отеля в TravelLine (propertyId)')
                            ->maxLength(255)
                            ->helperText(new \Illuminate\Support\HtmlString('После сохранения: <a href="/_integrations/travelline" target="_blank" rel="noopener">проверить подключение и открыть собственную форму поиска</a>. Доступ только администраторам.')),

                        TextInput::make('travelline_booking_url')
                            ->label('Ссылка на модуль бронирования')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Подвал сайта')
                    ->schema([
                        Textarea::make('footer_text')
                            ->label('Текст в подвале')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('company_name')
                            ->label('Наименование организации')
                            ->maxLength(255),

                        TextInput::make('company_inn')
                            ->label('ИНН')
                            ->maxLength(20),

                        TextInput::make('company_ogrn')
                            ->label('ОГРН / ОГРНИП')
                            ->maxLength(20),
                    ])
                    ->columns(3),

                Section::make('SEO по умолчанию')
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('SEO-заголовок')
                            ->maxLength(255),

                        Textarea::make('seo_description')
                            ->label('SEO-описание')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}