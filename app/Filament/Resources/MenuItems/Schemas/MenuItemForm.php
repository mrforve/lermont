<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Models\MenuItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('title')
                            ->label('Название пункта')
                            ->required()
                            ->maxLength(255),

                        Select::make('location')
                            ->label('Расположение')
                            ->options([
                                'header' => 'Главное меню',
                                'footer' => 'Меню в подвале',
                                'mobile' => 'Мобильное меню',
                            ])
                            ->default('header')
                            ->required(),

                        Select::make('parent_id')
                            ->label('Родительский пункт')
                            ->options(
                                fn (?MenuItem $record): array => MenuItem::query()
                                    ->when(
                                        $record,
                                        fn ($query) => $query->whereKeyNot($record->getKey())
                                    )
                                    ->orderBy('location')
                                    ->orderBy('sort_order')
                                    ->pluck('title', 'id')
                                    ->all()
                            )
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('page_id')
                            ->label('Связанная страница')
                            ->relationship(
                                name: 'page',
                                titleAttribute: 'title',
                                modifyQueryUsing: fn ($query) => $query
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Если выбрана страница, отдельную ссылку можно не указывать'),

                        TextInput::make('url')
                            ->label('Произвольная ссылка')
                            ->placeholder('/contacts или https://example.com')
                            ->maxLength(255)
                            ->nullable(),

                        Select::make('target')
                            ->label('Открывать ссылку')
                            ->options([
                                '_self' => 'В текущем окне',
                                '_blank' => 'В новой вкладке',
                            ])
                            ->default('_self')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Публикация')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}