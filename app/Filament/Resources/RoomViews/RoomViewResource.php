<?php

namespace App\Filament\Resources\RoomViews;

use App\Filament\Resources\RoomViews\Pages\CreateRoomView;
use App\Filament\Resources\RoomViews\Pages\EditRoomView;
use App\Filament\Resources\RoomViews\Pages\ListRoomViews;
use App\Filament\Resources\RoomViews\Schemas\RoomViewForm;
use App\Filament\Resources\RoomViews\Tables\RoomViewsTable;
use App\Models\RoomView;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RoomViewResource extends Resource
{
    protected static ?string $model = RoomView::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedWindow;

    protected static string|UnitEnum|null $navigationGroup =
        'Настройки';

    protected static ?int $navigationSort = 40;

    protected static ?string $modelLabel = 'вид и особенность номера';

    protected static ?string $pluralModelLabel = 'Виды и особенности номеров';

    protected static ?string $navigationLabel = 'Виды и особенности номеров';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RoomViewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoomViewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoomViews::route('/'),
            'create' => CreateRoomView::route('/create'),
            'edit' => EditRoomView::route('/{record}/edit'),
        ];
    }
}