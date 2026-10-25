<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('pages.offers', compact('promotions'));
    }

    public function show(string $slug): View
    {
        $promotion = Promotion::query()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.offer-show', compact('promotion'));
    }
}