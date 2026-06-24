<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['title', 'subtitle']);
            $table->string('fio');
            $table->string('position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['fio', 'position']);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
        });
    }
};
