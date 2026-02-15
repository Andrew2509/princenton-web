<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('client_name')->nullable()->after('title');
            $table->text('situation_text')->nullable()->after('tools');
            $table->text('task_text')->nullable()->after('situation_text');
            $table->text('action_text')->nullable()->after('task_text');
            $table->text('result_text')->nullable()->after('action_text');
            $table->string('live_link')->nullable()->after('image_url');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'client_name', 'situation_text', 'task_text',
                'action_text', 'result_text', 'live_link',
            ]);
        });
    }
};
