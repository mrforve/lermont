<?php
namespace App\Jobs;

use App\Mail\SiteContactRequestMail;
use App\Models\ContactRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactRequestEmail implements ShouldQueue
{
    use Queueable;
    public int $tries = 5;
    public int $timeout = 25;
    public function __construct(public int $contactRequestId)
    {
        $this->onQueue('site-notifications');
        $this->afterCommit();
    }
    public function backoff(): array { return [60, 300, 900, 1800]; }
    public function handle(): void
    {
        $request = ContactRequest::find($this->contactRequestId);
        if (!$request) return;
        Mail::mailer(config('site-requests.mailer'))->to(config('site-requests.recipient'))->send(new SiteContactRequestMail($request));
    }
}
