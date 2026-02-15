<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->json('experiences')->nullable()->after('tools');
            $table->json('educations')->nullable()->after('experiences');
            $table->string('cv_url', 500)->nullable()->after('educations');
            $table->string('secondary_badge', 255)->nullable()->after('cv_url');
        });
    }

    public function down(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->dropColumn(['experiences', 'educations', 'cv_url', 'secondary_badge']);
        });
    }
};
