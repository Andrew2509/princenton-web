<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('methodology_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('phase_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->default('search'); // Material icon name
            $table->string('image_url')->nullable();
            $table->json('tags')->nullable(); // e.g. ["User Interviews", "Audits"]
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('methodology_steps');
    }
};
