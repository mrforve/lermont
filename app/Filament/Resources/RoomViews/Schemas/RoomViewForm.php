<?php

namespace App\Filament\Resources\RoomViews\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoomViewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Вид и особенность номера')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Показывать на сайте')
                            ->helperText('Выключение скрывает пункт на сайте, сохраняя выбор в номерах.')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}