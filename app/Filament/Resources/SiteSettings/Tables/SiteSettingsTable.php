<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('Название сайта')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->placeholder('—'),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder('—'),

                TextColumn::make('updated_at')
                    ->label('Изменено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}