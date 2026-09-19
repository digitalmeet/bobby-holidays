<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sort_order' => 'integer',
    ];

    public const SENSITIVE_KEYS = [
        'razorpay_key_secret',
        'razorpay_webhook_secret',
    ];

    protected static function booted(): void
    {
        static::saved(fn (Setting $setting) => Cache::forget("setting_{$setting->key}"));
        static::deleted(fn (Setting $setting) => Cache::forget("setting_{$setting->key}"));
    }

    public static function valueFor(string $key, mixed $default = null): mixed
    {
        $value = static::query()->where('key', $key)->value('value');

        if ($value === null) {
            return $default;
        }

        if (!in_array($key, self::SENSITIVE_KEYS, true) || !str_starts_with($value, 'encrypted:')) {
            return $value;
        }

        try {
            return Crypt::decryptString(substr($value, strlen('encrypted:')));
        } catch (DecryptException) {
            return $default;
        }
    }

    public static function prepareValue(string $key, mixed $value): mixed
    {
        if (!in_array($key, self::SENSITIVE_KEYS, true) || $value === null || $value === '') {
            return $value;
        }

        return 'encrypted:' . Crypt::encryptString((string) $value);
    }

    public function activityLogHiddenAttributes(): array
    {
        return in_array($this->key, self::SENSITIVE_KEYS, true) ? ['value'] : [];
    }

    /**
     * Scope a query to only include settings for a specific group.
     */
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
