<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('template')
                    ->label('Шаблон')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'home' => 'Главная',
                        'contacts' => 'Контакты',
                        'rooms' => 'Номера',
                        'services' => 'Услуги',
                        default => 'Обычная',
                    })
                    ->badge()
                    ->sortable(),

                IconColumn::make('show_in_menu')
                    ->label('В меню')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Опубликована')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Изменена')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('template')
                    ->label('Шаблон')
                    ->options([
                        'default' => 'Обычная страница',
                        'home' => 'Главная',
                        'contacts' => 'Контакты',
                        'rooms' => 'Номера',
                        'services' => 'Услуги',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Статус')
                    ->options([
                        1 => 'Опубликованные',
                        0 => 'Скрытые',
                    ]),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                Action::make('viewOnSite')
                    ->label('Посмотреть на сайте')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(fn (Page $record): string => self::getPublicUrl($record))
                    ->openUrlInNewTab()
                    ->visible(fn (Page $record): bool => $record->is_active),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function getPublicUrl(Page $page): string
    {
        if ($page->template === 'home' || blank($page->slug)) {
            return url('/');
        }

        return url('/'.trim($page->slug, '/'));
    }
}
