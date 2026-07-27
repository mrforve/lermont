<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\View\View;

class RoomCatalogController extends Controller
{
    public function index(): View
    {
        $roomTypes = RoomType::query()
            ->where('is_active', true)
            ->with([
                'amenities',
                'images' => fn ($query) => $query
                    ->orderBy('sort_order'),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('rooms.index', [
            'roomTypes' => $roomTypes,
        ]);
    }

    public function show(RoomType $roomType): View
    {
        abort_unless($roomType->is_active, 404);

        $roomType->load([
            'amenities',
            'images' => fn ($query) => $query
                ->orderBy('sort_order'),
            'rooms' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('number'),
        ]);

        return view('rooms.show', [
            'roomType' => $roomType,
        ]);
    }
}