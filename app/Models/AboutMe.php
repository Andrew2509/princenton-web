<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    protected $table = 'about_me';

    protected $fillable = [
        'name', 'title', 'title_id', 'tagline', 'tagline_id', 'bio', 'bio_id', 'location', 'profile_image_url',
        'linkedin_url', 'github_url', 'dribbble_url',
        'story_text', 'story_text_id', 'philosophy_text', 'philosophy_text_id',
        'philosophies', 'philosophies_id', 'tools',
        'hero_heading', 'hero_heading_id', 'hero_subheading', 'hero_subheading_id',
        'stats_projects', 'stats_experience', 'stats_satisfaction',
        'experiences', 'experiences_id', 'educations', 'educations_id', 'cv_url', 'secondary_badge', 'secondary_badge_id',
    ];

    protected $casts = [
        'philosophies' => 'array',
        'philosophies_id' => 'array',
        'tools' => 'array',
        'experiences' => 'array',
        'experiences_id' => 'array',
        'educations' => 'array',
        'educations_id' => 'array',
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
