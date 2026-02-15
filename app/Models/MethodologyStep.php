<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MethodologyStep extends Model
{
    protected $fillable = [
        'phase_number', 'title', 'title_id', 'description', 'description_id', 'icon', 'color',
        'image_url', 'tags', 'sort_order',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Get localized field
     */
    public function t($field)
    {
        $locale = app()->getLocale();
        if ($locale === 'id') {
            $localizedField = $field . '_id';
            return $this->{$localizedField} ?? $this->{$field};
        }
        return $this->{$field};
    }
}
