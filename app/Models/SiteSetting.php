<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Get localized setting
     */
    public static function t(string $key, $default = null)
    {
        $locale = app()->getLocale();
        if ($locale === 'id') {
            $localizedKey = $key . '_id';
            $setting = static::where('key', $localizedKey)->first();
            if ($setting) {
                return $setting->value;
            }
        }
        return static::get($key, $default);
    }
}
