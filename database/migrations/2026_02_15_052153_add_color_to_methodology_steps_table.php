<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('methodology_steps', function (Blueprint $table) {
            $table->string('color', 50)->default('blue')->after('icon');
        });
    }

    public function down(): void
    {
        Schema::table('methodology_steps', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
