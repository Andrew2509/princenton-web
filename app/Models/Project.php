<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'title_id', 'client_name', 'category', 'tags', 'role', 'role_id', 'tools',
        'problem_text', 'problem_text_id', 'solution_text', 'solution_text_id',
        'situation_text', 'situation_text_id', 'task_text', 'task_text_id',
        'action_text', 'action_text_id', 'result_text', 'result_text_id',
        'image_url', 'live_link', 'sort_order', 'is_featured', 'status', 'year',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
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
