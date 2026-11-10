<?php
namespace App\Jobs;
use App\Models\ContactRequest;
use App\Models\SiteSetting;
use App\Support\MaxNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
class SendContactRequestMax implements ShouldQueue
{
    use Queueable;
    public int $tries = 8;
    public int $timeout = 25;
    public function __construct(public int $contactRequestId) { $this->onQueue('site-notifications'); $this->afterCommit(); }
    public function backoff(): array { return [60, 120, 300, 600, 900, 1800, 3600]; }
    public function handle(MaxNotifier $notifier): void
    {
        $settings = SiteSetting::query()->orderBy('id')->first();
        if (!$settings?->max_notifications_enabled) return;
        $lock = Cache::lock('max-contact-request-' . $this->contactRequestId, 30);
        if (!$lock->get()) { $this->release(10); return; }
        try {
            $request = ContactRequest::find($this->contactRequestId);
            if (!$request || $request->max_notified_at) return;
            if (RateLimiter::tooManyAttempts('max-site-notifications', 1)) { $this->release(2); return; }
            RateLimiter::hit('max-site-notifications', 1);
            $id = $notifier->sendText($notifier->contactText($request), $settings);
            // Update delivery metadata without creating an admin content-change event.
            ContactRequest::whereKey($request->id)->update(['max_notified_at' => now(), 'max_message_id' => $id]);
        } finally { $lock->release(); }
    }
}
