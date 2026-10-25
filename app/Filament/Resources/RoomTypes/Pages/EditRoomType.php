<?php

namespace App\Filament\Resources\RoomTypes\Pages;

use App\Filament\Resources\RoomTypes\RoomTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRoomType extends EditRecord
{
    protected static string $resource = RoomTypeResource::class;

    protected array $galleryUploads = [];

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->galleryUploads = $data['gallery_uploads'] ?? [];

        unset($data['gallery_uploads']);

        return $data;
    }

    protected function afterSave(): void
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

        $this->galleryUploads = [];
    }
}