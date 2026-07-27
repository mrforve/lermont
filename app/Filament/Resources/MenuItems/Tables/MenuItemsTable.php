<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Расположение')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'footer' => 'Подвал',
                        'mobile' => 'Мобильное',
                        default => 'Главное',
                    })
                    ->badge()
                    ->sortable(),

                TextColumn::make('parent.title')
                    ->label('Родитель')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('page.title')
                    ->label('Страница')
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('url')
                    ->label('Ссылка')
                    ->placeholder('Автоматически')
                    ->limit(40),

                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('location')
                    ->label('Расположение')
                    ->options([
                        'header' => 'Главное меню',
                        'footer' => 'Меню в подвале',
                        'mobile' => 'Мобильное меню',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Статус')
                    ->options([
                        1 => 'Активные',
                        0 => 'Неактивные',
                    ]),
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