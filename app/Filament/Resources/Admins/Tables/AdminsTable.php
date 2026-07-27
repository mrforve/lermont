<?php

namespace App\Filament\Resources\Admins\Tables;

use App\Models\Admin;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AdminsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('role')
                    ->label('Роль')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Admin::ROLE_SUPER_ADMIN => 'Главный администратор',
                        Admin::ROLE_CONTENT_MANAGER => 'Контент-менеджер',
                        Admin::ROLE_MANAGER => 'Менеджер',
                        default => $state,
                    })
                    ->badge()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Роль')
                    ->options([
                        Admin::ROLE_SUPER_ADMIN => 'Главный администратор',
                        Admin::ROLE_CONTENT_MANAGER => 'Контент-менеджер',
                        Admin::ROLE_MANAGER => 'Менеджер',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Статус')
                    ->options([
                        1 => 'Активные',
                        0 => 'Заблокированные',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
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