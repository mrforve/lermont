<?php

namespace App\Filament\Resources\RoomTypes\Pages;

use App\Filament\Resources\RoomTypes\RoomTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoomType extends CreateRecord
{
    protected static string $resource = RoomTypeResource::class;

    protected array $galleryUploads = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->galleryUploads = $data['gallery_uploads'] ?? [];

        unset($data['gallery_uploads']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if (empty($this->galleryUploads)) {
            return;
        }

        $startOrder = (int) ($this->record->images()->max('sort_order') ?? 0);

        foreach ($this->galleryUploads as $index => $image) {
            $this->record->images()->create([
                'image' => $image,
                'alt' => null,
                'sort_order' => $startOrder + $index + 1,
                'is_active' => true,
            ]);
        }
    }
}