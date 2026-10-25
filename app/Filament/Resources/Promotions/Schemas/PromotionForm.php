<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PromotionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Акция')
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
                        ->directory('offers')
                        ->visibility('public')
                        ->imageEditor()
                        ->columnSpanFull(),

                    TextInput::make('legacy_image_url')
                        ->label('Старое изображение по URL')
                        ->helperText('Используется только пока не загружено новое изображение.')
                        ->url()
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->label('Текст акции')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Кнопка')
                ->schema([
                    TextInput::make('button_text')
                        ->label('Текст кнопки')
                        ->maxLength(100),

                    TextInput::make('button_url')
                        ->label('Ссылка')
                        ->maxLength(500),
                ])
                ->columns(2),

            Section::make('Публикация')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Опубликована')
                        ->default(true),

                    TextInput::make('sort_order')
                        ->label('Порядок')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->required(),

                    DateTimePicker::make('starts_at')
                        ->label('Показывать с')
                        ->seconds(false),

                    DateTimePicker::make('ends_at')
                        ->label('Показывать до')
                        ->seconds(false),
                ])
                ->columns(4),
        ]);
    }
}
