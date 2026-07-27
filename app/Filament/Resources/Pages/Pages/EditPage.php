<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewOnSite')
                ->label('Посмотреть на сайте')
                ->icon(Heroicon::OutlinedEye)
                ->url(fn (): string => $this->getPublicUrl())
                ->openUrlInNewTab()
                ->visible(fn (): bool => (bool) $this->record->is_active),

            DeleteAction::make(),
        ];
    }

    private function getPublicUrl(): string
    {
        if ($this->record->template === 'home' || blank($this->record->slug)) {
            return url('/');
        }

        return url('/'.trim($this->record->slug, '/'));
    }
}
