<?php

namespace App\Filament\Resources\RoomViews\Pages;

use App\Filament\Resources\RoomViews\RoomViewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoomViews extends ListRecords
{
    protected static string $resource = RoomViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
