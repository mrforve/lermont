<?php

namespace App\Filament\Resources\Activities\Tables;

use App\Models\Admin;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable(),

                TextColumn::make('causer.name')
                    ->label('Администратор')
                    ->placeholder('Система')
                    ->searchable(),

                TextColumn::make('event')
                    ->label('Действие')
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'created' => 'Создание',
                            'updated' => 'Изменение',
                            'deleted' => 'Удаление',
                            'restored' => 'Восстановление',
                            default => $state ?: 'Действие',
                        }
                    )
                    ->badge()
                    ->sortable(),

                TextColumn::make('log_name')
                    ->label('Раздел')
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'Slide' => 'Слайды',
                            'Page' => 'Страницы',
                            'MenuItem' => 'Меню',
                            'SiteSetting' => 'Настройки сайта',
                            'RoomType' => 'Типы номеров',
                            'Room' => 'Номера',
                            'Amenity' => 'Удобства',
                            'RoomTypeImage' => 'Фотографии номеров',
                            'User' => 'Пользователи сайта',
                            'Admin' => 'Пользователи админки',
                            default => $state ?: 'Система',
                        }
                    )
                    ->badge()
                    ->sortable(),

                TextColumn::make('subject_id')
                    ->label('ID записи')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Описание')
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'created' => 'Запись создана',
                            'updated' => 'Запись изменена',
                            'deleted' => 'Запись удалена',
                            'restored' => 'Запись восстановлена',
                            default => $state ?: '—',
                        }
                    ),

                TextColumn::make('properties')
                    ->label('Изменения')
                    ->formatStateUsing(function (mixed $state): string {
                        $properties = self::propertiesToArray($state);

                        if ($properties === []) {
                            return '—';
                        }

                        $attributes = $properties['attributes'] ?? [];
                        $old = $properties['old'] ?? [];

                        if (! is_array($attributes) || $attributes === []) {
                            return '—';
                        }

                        $lines = [];

                        foreach ($attributes as $field => $newValue) {
                            $oldValue = $old[$field] ?? null;

                            $oldText = self::valueToString($oldValue);
                            $newText = self::valueToString($newValue);

                            if (array_key_exists($field, $old)) {
                                $lines[] = "{$field}: {$oldText} → {$newText}";
                            } else {
                                $lines[] = "{$field}: {$newText}";
                            }
                        }

                        return implode("\n", $lines);
                    })
                    ->wrap()
                    ->limit(500)
                    ->tooltip(function (mixed $state): ?string {
                        $properties = self::propertiesToArray($state);

                        if ($properties === []) {
                            return null;
                        }

                        return json_encode(
                            $properties,
                            JSON_UNESCAPED_UNICODE
                            | JSON_UNESCAPED_SLASHES
                            | JSON_PRETTY_PRINT
                        ) ?: null;
                    }),

                TextColumn::make('properties.ip_address')
                    ->label('IP')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('properties.user_agent')
                    ->label('Браузер')
                    ->limit(60)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->label('Действие')
                    ->options([
                        'created' => 'Создание',
                        'updated' => 'Изменение',
                        'deleted' => 'Удаление',
                        'restored' => 'Восстановление',
                    ]),

                SelectFilter::make('log_name')
                    ->label('Раздел')
                    ->options([
                        'Slide' => 'Слайды',
                        'Page' => 'Страницы',
                        'MenuItem' => 'Меню',
                        'SiteSetting' => 'Настройки сайта',
                        'RoomType' => 'Типы номеров',
                        'Room' => 'Номера',
                        'Amenity' => 'Удобства',
                        'RoomTypeImage' => 'Фотографии номеров',
                        'User' => 'Пользователи сайта',
                        'Admin' => 'Пользователи админки',
                    ]),

                SelectFilter::make('causer_id')
                    ->label('Администратор')
                    ->options(
                        fn (): array => Admin::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->query(function (Builder $query, array $data): Builder {
                        $adminId = $data['value'] ?? null;

                        return $query
                            ->when(
                                filled($adminId),
                                fn (Builder $query): Builder => $query
                                    ->where('causer_type', Admin::class)
                                    ->where('causer_id', $adminId)
                            );
                    })
                    ->searchable()
                    ->preload(),

                Filter::make('created_at')
                    ->label('Период')
                    ->form([
                        DatePicker::make('from')
                            ->label('Дата от')
                            ->native(false),

                        DatePicker::make('until')
                            ->label('Дата до')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, string $date): Builder =>
                                    $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn (Builder $query, string $date): Builder =>
                                    $query->whereDate('created_at', '<=', $date)
                            );
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([
                25,
                50,
                100,
            ]);
    }

    private static function propertiesToArray(mixed $state): array
    {
        if (is_array($state)) {
            return $state;
        }

        if ($state instanceof \Illuminate\Support\Collection) {
            return $state->toArray();
        }

        if (is_string($state)) {
            $decoded = json_decode($state, true);

            return is_array($decoded) ? $decoded : [];
        }

        if (is_object($state) && method_exists($state, 'toArray')) {
            $result = $state->toArray();

            return is_array($result) ? $result : [];
        }

        return [];
    }

    private static function valueToString(mixed $value): string
    {
        if ($value === null) {
            return 'пусто';
        }

        if (is_bool($value)) {
            return $value ? 'да' : 'нет';
        }

        if (is_array($value)) {
            return json_encode(
                $value,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );
        }

        return (string) $value;
    }
}