<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        Select::make('room_type_id')
                            ->label('Тип номера')
                            ->relationship('roomType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('number')
                            ->label('Номер')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('name')
                            ->label('Дополнительное название')
                            ->placeholder('Например: Семейный номер')
                            ->maxLength(255),

                        TextInput::make('floor')
                            ->label('Этаж')
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('building')
                            ->label('Корпус')
                            ->maxLength(255),

                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(4)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}