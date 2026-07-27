<?php

namespace App\Filament\Widgets;

use App\Models\ContactRequest;
use App\Models\Page;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Slide;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Новые заявки',
                ContactRequest::query()
                    ->where('status', ContactRequest::STATUS_NEW)
                    ->count()
            )
                ->description('Требуют обработки')
                ->color('danger')
                ->url(route('filament.admin.resources.contact-requests.index')),

            Stat::make(
                'Пользователи сайта',
                User::query()->count()
            )
                ->description(
                    'Активных: ' . User::query()
                        ->where('is_active', true)
                        ->count()
                )
                ->color('success')
                ->url(route('filament.admin.resources.users.index')),

            Stat::make(
                'Страницы',
                Page::query()->count()
            )
                ->description(
                    'Опубликовано: ' . Page::query()
                        ->where('is_active', true)
                        ->count()
                )
                ->color('info')
                ->url(route('filament.admin.resources.pages.index')),

            Stat::make(
                'Слайды',
                Slide::query()->count()
            )
                ->description(
                    'Активных: ' . Slide::query()
                        ->where('is_active', true)
                        ->count()
                )
                ->color('warning')
                ->url(route('filament.admin.resources.slides.index')),

            Stat::make(
                'Типы номеров',
                RoomType::query()->count()
            )
                ->description(
                    'Активных: ' . RoomType::query()
                        ->where('is_active', true)
                        ->count()
                )
                ->url(route('filament.admin.resources.room-types.index')),

            Stat::make(
                'Номера',
                Room::query()->count()
            )
                ->description(
                    'Активных: ' . Room::query()
                        ->where('is_active', true)
                        ->count()
                )
                ->url(route('filament.admin.resources.rooms.index')),
        ];
    }

    public static function canView(): bool
    {
        return auth('admin')->check();
    }
}