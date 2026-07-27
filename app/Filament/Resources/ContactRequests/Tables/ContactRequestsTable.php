<?php

namespace App\Filament\Resources\ContactRequests\Tables;

use App\Models\ContactRequest;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->placeholder('—')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder('—')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        ContactRequest::TYPE_CALLBACK => 'Обратный звонок',
                        ContactRequest::TYPE_QUESTION => 'Вопрос',
                        default => 'Сообщение',
                    })
                    ->badge(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        ContactRequest::STATUS_IN_PROGRESS => 'В работе',
                        ContactRequest::STATUS_PROCESSED => 'Обработана',
                        ContactRequest::STATUS_CANCELLED => 'Отменена',
                        default => 'Новая',
                    })
                    ->badge()
                    ->sortable(),

                TextColumn::make('message')
                    ->label('Сообщение')
                    ->limit(60)
                    ->placeholder('—'),

                TextColumn::make('processed_at')
                    ->label('Обработана')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('—')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        ContactRequest::TYPE_MESSAGE => 'Сообщение',
                        ContactRequest::TYPE_CALLBACK => 'Обратный звонок',
                        ContactRequest::TYPE_QUESTION => 'Вопрос',
                    ]),

                SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        ContactRequest::STATUS_NEW => 'Новая',
                        ContactRequest::STATUS_IN_PROGRESS => 'В работе',
                        ContactRequest::STATUS_PROCESSED => 'Обработана',
                        ContactRequest::STATUS_CANCELLED => 'Отменена',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ]);
    }
}