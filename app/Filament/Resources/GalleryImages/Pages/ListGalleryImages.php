<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Models\GalleryImage;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListGalleryImages extends ListRecords
{
    protected static string $resource = GalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('uploadMultiple')
                ->label('Загрузить несколько фото')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('primary')
                ->modalHeading('Множественная загрузка фотографий')
                ->modalDescription('Выберите сразу несколько изображений. Все они будут добавлены в выбранный раздел галереи.')
                ->modalSubmitActionLabel('Загрузить фотографии')
                ->schema([
                    FileUpload::make('images')
                        ->label('Фотографии')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->appendFiles()
                        ->disk('public')
                        ->directory('gallery')
                        ->visibility('public')
                        ->imagePreviewHeight('180')
                        ->panelLayout('grid')
                        ->required()
                        ->columnSpanFull(),
                    Select::make('category')
                        ->label('Раздел')
                        ->options([
                            'hotel' => 'Отель',
                            'rooms' => 'Номера',
                            'breakfast' => 'Завтраки',
                            'location' => 'Локация',
                            'details' => 'Детали',
                        ])
                        ->default('hotel')
                        ->required(),
                    Toggle::make('is_active')
                        ->label('Сразу показывать на сайте')
                        ->default(true),
                ])
                ->action(function (array $data): void {
                    $images = array_values($data['images'] ?? []);

                    if ($images === []) {
                        return;
                    }

                    $sortOrder = (int) GalleryImage::query()->max('sort_order');

                    foreach ($images as $image) {
                        $sortOrder++;

                        GalleryImage::query()->create([
                            'image' => $image,
                            'category' => $data['category'],
                            'sort_order' => $sortOrder,
                            'is_active' => (bool) ($data['is_active'] ?? true),
                        ]);
                    }

                    Notification::make()
                        ->title('Фотографии загружены')
                        ->body('Добавлено фотографий: ' . count($images))
                        ->success()
                        ->send();
                }),
            CreateAction::make()
                ->label('Добавить одно фото'),
        ];
    }
}
