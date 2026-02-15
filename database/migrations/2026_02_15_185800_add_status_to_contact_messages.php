<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('status')->default('new')->after('is_read');
        });

        // Migrate existing data: is_read=true → status=replied
        \Illuminate\Support\Facades\DB::table('contact_messages')->where('is_read', true)->update(['status' => 'replied']);
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
