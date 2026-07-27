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

                Section::make('TravelLine')
                    ->description('Пока сохраняем только параметры для будущего подключения')
                    ->schema([
                        TextInput::make('travelline_hotel_id')
                            ->label('ID отеля в TravelLine')
                            ->maxLength(255),

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