<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->string('tagline', 500)->nullable()->after('title');
            $table->string('linkedin_url', 500)->nullable()->after('profile_image_url');
            $table->string('github_url', 500)->nullable()->after('linkedin_url');
            $table->string('dribbble_url', 500)->nullable()->after('github_url');
            $table->json('philosophies')->nullable()->after('philosophy_text');
            $table->json('tools')->nullable()->after('philosophies');
        });
    }

    public function down(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'linkedin_url', 'github_url', 'dribbble_url', 'philosophies', 'tools']);
        });
    }
};
