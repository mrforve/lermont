<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $newsItems = ContentItem::query()
            ->published()
            ->inCategory('news')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9);

        return view('news.index', compact('newsItems'));
    }

    public function show(ContentItem $news): View
    {
        abort_unless(
            $news->is_active &&
            $news->category?->slug === 'news',
            404
        );

        abort_if(
            $news->published_at &&
            $news->published_at->isFuture(),
            404
        );

        abort_if(
            $news->starts_at &&
            $news->starts_at->isFuture(),
            404
        );

        abort_if(
            $news->ends_at &&
            $news->ends_at->isPast(),
            404
        );

        return view('news.show', compact('news'));
    }
}