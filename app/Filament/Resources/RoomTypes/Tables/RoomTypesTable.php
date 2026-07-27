<?php

namespace App\Filament\Resources\RoomTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoomTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image')
                    ->label('Фото')
                    ->disk('public')
                    ->height(60)
                    ->width(90),

                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('Основных мест')
                    ->sortable(),

                TextColumn::make('extra_capacity')
                    ->label('Доп. мест')
                    ->sortable(),

                TextColumn::make('area')
                    ->label('Площадь')
                    ->suffix(' м²')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('base_price')
                    ->label('Базовая цена')
                    ->money('RUB')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}