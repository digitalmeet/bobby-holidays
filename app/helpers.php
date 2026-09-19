<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 300, function () use ($key, $default) {
            return Setting::valueFor($key, $default);
        });
    }
}

if (!function_exists('encrypted_query')) {
    function encrypted_query(array $values): string
    {
        return Crypt::encryptString(json_encode(array_filter($values, fn ($value) => $value !== null && $value !== ''), JSON_THROW_ON_ERROR));
    }
}

if (!function_exists('media_url')) {
    function media_url(?string $path, ?string $fallback = null): ?string
    {
        if (!$path) {
            return asset($fallback ?: 'assets/frontend/images/image-placeholder.svg');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with(ltrim($path, '/'), 'assets/')) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
