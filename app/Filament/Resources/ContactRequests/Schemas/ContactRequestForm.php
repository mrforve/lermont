<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use App\Models\ContactRequest;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Данные заявки')
                    ->schema([
                        Select::make('type')
                            ->label('Тип заявки')
                            ->options([
                                ContactRequest::TYPE_MESSAGE => 'Сообщение',
                                ContactRequest::TYPE_CALLBACK => 'Обратный звонок',
                                ContactRequest::TYPE_QUESTION => 'Вопрос',
                            ])
                            ->disabled()
                            ->dehydrated(false),

                        Select::make('status')
                            ->label('Статус')
                            ->options([
                                ContactRequest::STATUS_NEW => 'Новая',
                                ContactRequest::STATUS_IN_PROGRESS => 'В работе',
                                ContactRequest::STATUS_PROCESSED => 'Обработана',
                                ContactRequest::STATUS_CANCELLED => 'Отменена',
                            ])
                            ->required(),

                        TextInput::make('name')
                            ->label('Имя')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('phone')
                            ->label('Телефон')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('email')
                            ->label('Email')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('subject')
                            ->label('Тема')
                            ->disabled()
                            ->dehydrated(false),

                        Textarea::make('message')
                            ->label('Сообщение')
                            ->rows(6)
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Обработка')
                    ->schema([
                        Textarea::make('admin_comment')
                            ->label('Комментарий администратора')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Служебные данные')
                    ->collapsed()
                    ->schema([
                        TextInput::make('source_url')
                            ->label('Страница отправки')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('ip_address')
                            ->label('IP')
                            ->disabled()
                            ->dehydrated(false),

                        Textarea::make('user_agent')
                            ->label('User Agent')
                            ->rows(3)
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),

                        TextInput::make('consent_at')
                            ->label('Согласие принято')
                            ->formatStateUsing(
                                fn ($state): string => $state
                                    ? \Illuminate\Support\Carbon::parse($state)
                                        ->format('d.m.Y H:i:s')
                                    : 'Не зафиксировано'
                            )
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('consent_text_version')
                            ->label('Версия текста согласия')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }
}