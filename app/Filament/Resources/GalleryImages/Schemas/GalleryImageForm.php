<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Фотография')->schema([
                FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->visibility('public')
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')->label('Название')->maxLength(255),
                TextInput::make('alt')->label('Alt-текст')->maxLength(255),
                Select::make('category')->label('Раздел')->options([
                    'hotel' => 'Отель',
                    'rooms' => 'Номера',
                    'breakfast' => 'Завтраки',
                    'location' => 'Локация',
                    'details' => 'Детали',
                ])->default('hotel')->required(),
                TextInput::make('sort_order')->label('Порядок')->numeric()->default(0)->minValue(0)->required(),
                Toggle::make('is_active')->label('Показывать на сайте')->default(true),
            ])->columns(2),
        ]);
    }
}
