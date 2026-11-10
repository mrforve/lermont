@php($viewOptions = \App\Models\RoomView::options(true))
@if (array_intersect($roomType->room_views ?? [], array_keys($viewOptions)))
    @if ($factLayout ?? false)
        @foreach ($roomType->room_views as $view)
            @if (isset($viewOptions[$view]))
                <div class="room-showcase__fact"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="1"/><path d="M12 3v18M3 12h18"/></svg><span>{{ $viewOptions[$view] }}</span></div>
            @endif
        @endforeach
    @else
        <ul class="room-views" aria-label="Вид из номера и особенности">
            @foreach ($roomType->room_views as $view)
                @if (isset($viewOptions[$view]))
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="1"/><path d="M12 3v18M3 12h18"/></svg><span>{{ $viewOptions[$view] }}</span></li>
                @endif
            @endforeach
        </ul>
    @endif
@endif
