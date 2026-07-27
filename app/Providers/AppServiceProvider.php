<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $settings = SiteSetting::query()->first();

            $headerMenu = MenuItem::query()
                ->with([
                    'page',
                    'children' => fn ($query) => $query
                        ->where('is_active', true)
                        ->orderBy('sort_order'),
                    'children.page',
                ])
                ->where('location', 'header')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $footerMenu = MenuItem::query()
                ->with([
                    'page',
                    'children' => fn ($query) => $query
                        ->where('is_active', true)
                        ->orderBy('sort_order'),
                    'children.page',
                ])
                ->where('location', 'footer')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'settings' => $settings,
                'headerMenu' => $headerMenu,
                'footerMenu' => $footerMenu,
            ]);
        });
    }
}