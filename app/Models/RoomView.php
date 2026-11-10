<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class RoomView extends Model
{
    protected $fillable = ['name','sort_order','is_active'];
    protected function casts(): array { return ['sort_order'=>'integer','is_active'=>'boolean']; }
    protected static function booted(): void {
        static::creating(function (self $view): void { $view->key ??= (string) Str::uuid(); });
    }
    public static function options(bool $activeOnly = false): array {
        return static::query()->when($activeOnly,fn($q)=>$q->where('is_active',true))
            ->orderBy('sort_order')->orderBy('id')->get()->mapWithKeys(fn($v)=>[$v->key=>$v->name . (!$activeOnly && !$v->is_active ? ' (скрыто)' : '')])->all();
    }
}
