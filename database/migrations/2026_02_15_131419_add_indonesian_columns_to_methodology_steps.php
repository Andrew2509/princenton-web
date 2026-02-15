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
        Schema::table('methodology_steps', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('title');
            $table->text('description_id')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('methodology_steps', function (Blueprint $table) {
            $table->dropColumn(['title_id', 'description_id']);
        });
    }
};
