<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactRequests\ContactRequestResource;
use App\Models\ContactRequest;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestContactRequests extends TableWidget
{
    protected static ?string $heading = 'Последние заявки';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactRequest::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->placeholder('—')
                    ->copyable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder('—')
                    ->copyable(),

                TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            ContactRequest::TYPE_CALLBACK => 'Обратный звонок',
                            ContactRequest::TYPE_QUESTION => 'Вопрос',
                            default => 'Сообщение',
                        }
                    )
                    ->badge(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            ContactRequest::STATUS_IN_PROGRESS => 'В работе',
                            ContactRequest::STATUS_PROCESSED => 'Обработана',
                            ContactRequest::STATUS_CANCELLED => 'Отменена',
                            default => 'Новая',
                        }
                    )
                    ->badge(),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Открыть')
                    ->icon('heroicon-o-pencil-square')
                    ->url(
                        fn (ContactRequest $record): string =>
                            ContactRequestResource::getUrl('edit', [
                                'record' => $record,
                            ])
                    ),
            ])
            ->paginated(false);
    }

    public static function canView(): bool
    {
        $admin = auth('admin')->user();

        return $admin !== null
            && (
                $admin->isSuperAdmin()
                || $admin->isManager()
            );
    }
}