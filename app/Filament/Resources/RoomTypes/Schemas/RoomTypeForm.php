<?php

namespace App\Filament\Resources\RoomTypes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class RoomTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, callable $set): void {
                                $set('slug', Str::slug($state ?? ''));
                            }),

                        TextInput::make('slug')
                            ->label('URL')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Textarea::make('short_description')
                            ->label('Краткое описание')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Полное описание')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Размещение')
                    ->schema([
                        TextInput::make('capacity')
                            ->label('Основных мест')
                            ->numeric()
                            ->required()
                            ->default(2)
                            ->minValue(1),

                        TextInput::make('extra_capacity')
                            ->label('Дополнительных мест')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->minValue(0),

                        TextInput::make('area')
                            ->label('Площадь, м²')
                            ->numeric()
                            ->minValue(1),

                        TextInput::make('base_price')
                            ->label('Базовая цена')
                            ->numeric()
                            ->prefix('₽')
                            ->minValue(0),
                    ])
                    ->columns(4),

                Section::make('Изображение')
                    ->schema([
                        FileUpload::make('main_image')
                            ->label('Основное изображение')
                            ->image()
                            ->disk('public')
                            ->directory('room-types')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('Удобства')
                    ->schema([
                        Select::make('amenities')
                            ->label('Удобства номера')
                            ->relationship(
                                name: 'amenities',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                            )
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                Section::make('Галерея')
                    ->description('Дополнительные фотографии типа номера')
                    ->schema([
                        Repeater::make('images')
                            ->label('')
                            ->relationship()
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Изображение')
                                    ->image()
                                    ->disk('public')
                                    ->directory('room-types/gallery')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('alt')
                                    ->label('Описание изображения')
                                    ->placeholder('Например: Интерьер номера Стандарт')
                                    ->maxLength(255),

                                TextInput::make('sort_order')
                                    ->label('Порядок')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->required(),

                                Toggle::make('is_active')
                                    ->label('Активно')
                                    ->default(true),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Добавить фотографию')
                            ->reorderable()
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ]),

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

                Section::make('SEO')
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('SEO-заголовок')
                            ->maxLength(255),

                        Textarea::make('seo_description')
                            ->label('SEO-описание')
                            ->rows(3),
                    ])
                    ->columns(2),
            ]);
    }
}