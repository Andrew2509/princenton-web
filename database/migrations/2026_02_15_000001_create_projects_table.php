<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default(''); // e.g. "ui-ux development saas"
            $table->json('tags')->nullable(); // e.g. ["UI/UX Design", "Frontend Dev"]
            $table->string('role')->nullable();
            $table->string('tools')->nullable();
            $table->text('problem_text')->nullable();
            $table->text('solution_text')->nullable();
            $table->string('image_url', 1000)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('completed'); // completed, in-progress
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
