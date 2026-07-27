<?php

namespace App\Filament\Resources\ContentItems\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ContentItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        Select::make('content_category_id')
                            ->label('Категория')
                            ->relationship(
                                name: 'category',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->orderBy('name')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
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
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->disk('public')
                            ->directory('content-items')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Textarea::make('short_description')
                            ->label('Краткое описание')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Содержимое')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Кнопка')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Текст кнопки')
                            ->maxLength(100),

                        TextInput::make('button_url')
                            ->label('Ссылка кнопки')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Публикация')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),

                        Toggle::make('show_on_home')
                            ->label('Показывать на главной')
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->label('Дата публикации')
                            ->seconds(false),

                        DateTimePicker::make('starts_at')
                            ->label('Начало показа')
                            ->seconds(false),

                        DateTimePicker::make('ends_at')
                            ->label('Окончание показа')
                            ->seconds(false),
                    ])
                    ->columns(3),

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