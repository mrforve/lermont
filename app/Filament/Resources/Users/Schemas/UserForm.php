<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основные данные')
                    ->schema([
                        TextInput::make('name')
                            ->label('Имя')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('last_name')
                            ->label('Фамилия')
                            ->maxLength(255),

                        TextInput::make('middle_name')
                            ->label('Отчество')
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Телефон')
                            ->tel()
                            ->maxLength(50),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Пароль')
                    ->description('При редактировании оставьте поле пустым, чтобы не менять пароль')
                    ->schema([
                        TextInput::make('password')
                            ->label('Пароль')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->minLength(8)
                            ->maxLength(255)
                            ->dehydrateStateUsing(
                                fn (?string $state): ?string => filled($state)
                                    ? Hash::make($state)
                                    : null
                            )
                            ->dehydrated(
                                fn (?string $state): bool => filled($state)
                            ),

                        TextInput::make('password_confirmation')
                            ->label('Повторите пароль')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->same('password')
                            ->dehydrated(false),
                    ])
                    ->columns(2),

                Section::make('Служебная информация')
                    ->schema([
                        Toggle::make('email_verified')
                            ->label('Email подтверждён')
                            ->default(false),

                        TextInput::make('created_at')
                            ->label('Дата регистрации')
                            ->disabled()
                            ->dehydrated(false),
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
                            ->label('Версия согласия')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2)
                    ->visible(fn (string $operation): bool => $operation === 'edit'),
            ]);
    }
}