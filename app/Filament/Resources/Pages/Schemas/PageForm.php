<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('title')
                            ->label('Заголовок')
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
                            ->maxLength(255)
                            ->helperText('Например: about, contacts, services'),

                        TextInput::make('menu_title')
                            ->label('Название в меню')
                            ->maxLength(255)
                            ->helperText('Если пусто, используется основной заголовок'),

                        Select::make('template')
                            ->label('Шаблон страницы')
                            ->options([
                                'default' => 'Обычная страница',
                                'home' => 'Главная страница',
                                'contacts' => 'Контакты',
                                'rooms' => 'Номера',
                                'services' => 'Услуги',
                            ])
                            ->default('default')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Содержимое страницы')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Вводный текст')
                            ->helperText('Необязательный текст перед блоками')
                            ->columnSpanFull(),

                        Builder::make('blocks')
                            ->label('Контентные блоки')
                            ->addActionLabel('Добавить блок')
                            ->blockNumbers(false)
                            ->collapsible()
                            ->cloneable()
                            ->reorderable()
                            ->blocks([
                                Block::make('text')
                                    ->label('Текст')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Заголовок')
                                            ->maxLength(255),

                                        RichEditor::make('content')
                                            ->label('Текст')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),

                                Block::make('image')
                                    ->label('Изображение')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Изображение')
                                            ->image()
                                            ->disk('public')
                                            ->directory('pages/images')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->required()
                                            ->columnSpanFull(),

                                        TextInput::make('alt')
                                            ->label('Описание изображения')
                                            ->maxLength(255),

                                        TextInput::make('caption')
                                            ->label('Подпись')
                                            ->maxLength(255),

                                        Select::make('position')
                                            ->label('Расположение')
                                            ->options([
                                                'full' => 'На всю ширину',
                                                'left' => 'Изображение слева',
                                                'right' => 'Изображение справа',
                                            ])
                                            ->default('full')
                                            ->required(),
                                    ])
                                    ->columns(2),

                                Block::make('gallery')
                                    ->label('Галерея')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Заголовок галереи')
                                            ->maxLength(255),

                                        FileUpload::make('images')
                                            ->label('Изображения')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->disk('public')
                                            ->directory('pages/galleries')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->columnSpanFull(),
                                    ]),

                                Block::make('features')
                                    ->label('Преимущества')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Заголовок блока')
                                            ->maxLength(255),

                                        Repeater::make('items')
                                            ->label('Преимущества')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Название')
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description')
                                                    ->label('Описание')
                                                    ->rows(3),

                                                TextInput::make('icon')
                                                    ->label('Иконка')
                                                    ->placeholder('Например: wifi, parking')
                                                    ->maxLength(100),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(1)
                                            ->addActionLabel('Добавить преимущество')
                                            ->reorderable()
                                            ->collapsible()
                                            ->columnSpanFull(),
                                    ]),

                                Block::make('button')
                                    ->label('Кнопка')
                                    ->icon('heroicon-o-cursor-arrow-rays')
                                    ->schema([
                                        TextInput::make('text')
                                            ->label('Текст кнопки')
                                            ->required()
                                            ->maxLength(100),

                                        TextInput::make('url')
                                            ->label('Ссылка')
                                            ->required()
                                            ->maxLength(255),

                                        Select::make('style')
                                            ->label('Стиль')
                                            ->options([
                                                'primary' => 'Основная',
                                                'secondary' => 'Второстепенная',
                                                'outline' => 'Контурная',
                                            ])
                                            ->default('primary')
                                            ->required(),
                                    ])
                                    ->columns(3),

                                Block::make('html')
                                    ->label('HTML-код')
                                    ->icon('heroicon-o-code-bracket')
                                    ->schema([
                                        Textarea::make('html')
                                            ->label('HTML')
                                            ->rows(10)
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Публикация')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Опубликована')
                            ->default(true),

                        Toggle::make('show_in_menu')
                            ->label('Показывать в меню')
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
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
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}