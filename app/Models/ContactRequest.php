<?php

namespace App\Models;

use App\Models\Concerns\LogsAdminActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactRequest extends Model
{
    use LogsAdminActivity;

    public const TYPE_MESSAGE = 'message';
    public const TYPE_CALLBACK = 'callback';
    public const TYPE_QUESTION = 'question';

    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_PROCESSED = 'processed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'status',
        'admin_comment',
        'source_url',
        'ip_address',
        'user_agent',
        'processed_at',
        'consent_at',
        'consent_text_version',
    ];

    protected function casts(): array
    {
        return [
            'processed_at' => 'datetime',
            'consent_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}