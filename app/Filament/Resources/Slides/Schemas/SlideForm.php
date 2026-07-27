<?php

namespace App\Filament\Resources\Slides\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Содержимое слайда')
                    ->schema([
                        TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('button_text')
                            ->label('Текст кнопки')
                            ->maxLength(100),

                        TextInput::make('button_url')
                            ->label('Ссылка кнопки')
                            ->placeholder('/booking или https://...')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Изображения')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Изображение для компьютера')
                            ->image()
                            ->disk('public')
                            ->directory('slides/desktop')
                            ->visibility('public')
                            ->imageEditor()
                            ->required(),

                        FileUpload::make('mobile_image')
                            ->label('Изображение для телефона')
                            ->image()
                            ->disk('public')
                            ->directory('slides/mobile')
                            ->visibility('public')
                            ->imageEditor(),
                    ])
                    ->columns(2),

                Section::make('Публикация')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),

                        DateTimePicker::make('starts_at')
                            ->label('Начало показа')
                            ->seconds(false)
                            ->native(false),

                        DateTimePicker::make('ends_at')
                            ->label('Окончание показа')
                            ->seconds(false)
                            ->native(false)
                            ->afterOrEqual('starts_at'),
                    ])
                    ->columns(2),
            ]);
    }
}