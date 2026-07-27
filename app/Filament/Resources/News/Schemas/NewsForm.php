<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Hidden::make('content_category_id'),

            Section::make('Новость')
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
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->disk('public')
                        ->directory('news')
                        ->visibility('public')
                        ->imageEditor()
                        ->required()
                        ->columnSpanFull(),

                    Textarea::make('short_description')
                        ->label('Краткое описание для карточки')
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->label('Полный текст')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Публикация')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Опубликована')
                        ->default(true),

                    Toggle::make('show_on_home')
                        ->label('Показывать на главной')
                        ->default(true),

                    TextInput::make('sort_order')
                        ->label('Порядок')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->label('Дата публикации')
                        ->default(now())
                        ->seconds(false),
                ])
                ->columns(4),

            Section::make('Ссылка')
                ->description('Можно оставить пустой — карточка будет вести на внутреннюю страницу новости.')
                ->schema([
                    TextInput::make('button_text')
                        ->label('Текст ссылки')
                        ->default('Подробнее')
                        ->maxLength(100),

                    TextInput::make('button_url')
                        ->label('Внешняя ссылка')
                        ->maxLength(255),
                ])
                ->columns(2)
                ->collapsed(),

            Section::make('SEO')
                ->schema([
                    TextInput::make('seo_title')
                        ->label('SEO-заголовок')
                        ->maxLength(255),

                    Textarea::make('seo_description')
                        ->label('SEO-описание')
                        ->rows(3),
                ])
                ->columns(2)
                ->collapsed(),
        ]);
    }
}
