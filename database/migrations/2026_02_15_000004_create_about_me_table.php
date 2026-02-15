<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_me', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('John Doe');
            $table->string('title')->default('UI/UX Designer & Web Developer');
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('profile_image_url', 1000)->nullable();
            $table->text('story_text')->nullable();
            $table->text('philosophy_text')->nullable();
            $table->string('hero_heading')->nullable();
            $table->string('hero_subheading')->nullable();
            $table->string('stats_projects')->default('50+');
            $table->string('stats_experience')->default('6thn');
            $table->string('stats_satisfaction')->default('100%');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_me');
    }
};
