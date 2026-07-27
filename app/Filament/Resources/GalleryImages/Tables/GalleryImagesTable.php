<?php

namespace App\Filament\Resources\GalleryImages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image')->label('Фото')->disk('public')->height(70)->width(110),
                TextColumn::make('title')->label('Название')->placeholder('Без названия')->searchable(),
                TextColumn::make('category')->label('Раздел')->formatStateUsing(fn (string $state): string => match ($state) {
                    'rooms' => 'Номера', 'breakfast' => 'Завтраки', 'location' => 'Локация', 'details' => 'Детали', default => 'Отель',
                })->badge()->sortable(),
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                IconColumn::make('is_active')->label('Активно')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
