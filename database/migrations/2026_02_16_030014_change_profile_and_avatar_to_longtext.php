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
            $table->longText('profile_image_url')->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->longText('avatar_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_me', function (Blueprint $table) {
            $table->string('profile_image_url', 500)->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_url', 500)->nullable()->change();
        });
    }
};
