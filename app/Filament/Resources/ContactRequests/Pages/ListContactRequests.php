<?php

namespace App\Filament\Resources\ContactRequests\Pages;

use App\Filament\Resources\ContactRequests\ContactRequestResource;
use App\Models\ContactRequest;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContactRequests extends ListRecords
{
    protected static string $resource = ContactRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Все'),

            'new' => Tab::make('Новые')
                ->modifyQueryUsing(
                    fn (Builder $query): Builder =>
                        $query->where(
                            'status',
                            ContactRequest::STATUS_NEW
                        )
                )
                ->badge(
                    ContactRequest::query()
                        ->where('status', ContactRequest::STATUS_NEW)
                        ->count()
                ),

            'in_progress' => Tab::make('В работе')
                ->modifyQueryUsing(
                    fn (Builder $query): Builder =>
                        $query->where(
                            'status',
                            ContactRequest::STATUS_IN_PROGRESS
                        )
                ),

            'processed' => Tab::make('Обработанные')
                ->modifyQueryUsing(
                    fn (Builder $query): Builder =>
                        $query->where(
                            'status',
                            ContactRequest::STATUS_PROCESSED
                        )
                ),

            'cancelled' => Tab::make('Отменённые')
                ->modifyQueryUsing(
                    fn (Builder $query): Builder =>
                        $query->where(
                            'status',
                            ContactRequest::STATUS_CANCELLED
                        )
                ),
        ];
    }
}