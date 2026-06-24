<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            Schema::whenTableDoesntHaveColumn($table->getTable(), 'content', function (Blueprint $table) {
                $table->json('content')->after('image_preview')->nullable();
            });
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'content', function (Blueprint $table) {
                $table->dropColumn('content');
            });
        });
    }
};
