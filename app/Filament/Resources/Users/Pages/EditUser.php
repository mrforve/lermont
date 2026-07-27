<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['email_verified'] = $this->record->email_verified_at !== null;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $emailVerified = (bool) ($data['email_verified'] ?? false);

        unset($data['email_verified']);

        $data['email_verified_at'] = $emailVerified
            ? ($this->record->email_verified_at ?? now())
            : null;

        return $data;
    }
}