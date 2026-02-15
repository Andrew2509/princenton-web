<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('title');
            $table->string('tagline_id', 500)->nullable()->after('tagline');
            $table->text('bio_id')->nullable()->after('bio');
            $table->text('story_text_id')->nullable()->after('story_text');
            $table->text('philosophy_text_id')->nullable()->after('philosophy_text');
            $table->string('hero_heading_id')->nullable()->after('hero_heading');
            $table->string('hero_subheading_id')->nullable()->after('hero_subheading');
            $table->string('secondary_badge_id')->nullable()->after('secondary_badge');

            // JSON fields for translations
            $table->json('philosophies_id')->nullable()->after('philosophies');
            $table->json('experiences_id')->nullable()->after('experiences');
            $table->json('educations_id')->nullable()->after('educations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->dropColumn([
                'title_id', 'tagline_id', 'bio_id', 'story_text_id',
                'philosophy_text_id', 'hero_heading_id', 'hero_subheading_id',
                'secondary_badge_id', 'philosophies_id', 'experiences_id', 'educations_id'
            ]);
        });
    }
};
