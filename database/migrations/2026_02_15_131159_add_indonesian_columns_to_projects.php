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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('title');
            $table->string('role_id')->nullable()->after('role');
            $table->text('problem_text_id')->nullable()->after('problem_text');
            $table->text('solution_text_id')->nullable()->after('solution_text');
            $table->text('situation_text_id')->nullable()->after('situation_text');
            $table->text('task_text_id')->nullable()->after('task_text');
            $table->text('action_text_id')->nullable()->after('action_text');
            $table->text('result_text_id')->nullable()->after('result_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'title_id', 'role_id', 'problem_text_id', 'solution_text_id',
                'situation_text_id', 'task_text_id', 'action_text_id', 'result_text_id'
            ]);
        });
    }
};
