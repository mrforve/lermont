<?php

namespace App\Filament\Resources\RoomViews\Pages;

use App\Filament\Resources\RoomViews\RoomViewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRoomView extends EditRecord
{
    protected static string $resource = RoomViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
