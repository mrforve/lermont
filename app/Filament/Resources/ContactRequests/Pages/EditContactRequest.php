<?php

namespace App\Filament\Resources\ContactRequests\Pages;

use App\Filament\Resources\ContactRequests\ContactRequestResource;
use App\Models\ContactRequest;
use App\Notifications\ContactRequestStatusChanged;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactRequest extends EditRecord
{
    protected static string $resource = ContactRequestResource::class;

    private ?string $oldStatus = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(
                    fn (): bool =>
                        auth('admin')->user()?->isSuperAdmin() ?? false
                ),
        ];
    }

    protected function beforeSave(): void
    {
        $this->oldStatus = $this->record->status;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $status = $data['status'] ?? ContactRequest::STATUS_NEW;

        if ($status === ContactRequest::STATUS_PROCESSED) {
            $data['processed_at'] = $this->record->processed_at ?? now();
        } else {
            $data['processed_at'] = null;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        if (
            $this->oldStatus === $this->record->status
            || $this->record->user === null
        ) {
            return;
        }

        $this->record->user->notify(
            new ContactRequestStatusChanged($this->record)
        );
    }
}