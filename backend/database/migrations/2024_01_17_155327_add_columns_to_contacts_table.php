<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->json('coords')->nullable()->after('address');
            $table->string('telegram')->nullable()->after('coords');
            $table->string('whatsapp')->nullable()->after('telegram');
            $table->string('vk')->nullable()->after('whatsapp');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['coords', 'telegram', 'whatsapp', 'vk']);
        });
    }
};
