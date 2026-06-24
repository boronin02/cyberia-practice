<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'phone', function (Blueprint $table) {
                $table->dropColumn('phone');
            });

            Schema::whenTableHasColumn($table->getTable(), 'email', function (Blueprint $table) {
                $table->dropColumn('email');
            });

            Schema::whenTableHasColumn($table->getTable(), 'address', function (Blueprint $table) {
                $table->dropColumn('address');
            });

            Schema::whenTableHasColumn($table->getTable(), 'coords', function (Blueprint $table) {
                $table->dropColumn('coords');
            });

            Schema::whenTableHasColumn($table->getTable(), 'telegram', function (Blueprint $table) {
                $table->dropColumn('telegram');
            });

            Schema::whenTableHasColumn($table->getTable(), 'whatsapp', function (Blueprint $table) {
                $table->dropColumn('whatsapp');
            });

            Schema::whenTableHasColumn($table->getTable(), 'vk', function (Blueprint $table) {
                $table->dropColumn('vk');
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'key', function (Blueprint $table) {
                $table->string('key')->unique()->after('id');
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'value', function (Blueprint $table) {
                $table->text('value')->nullable()->after('key');
            });
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'key', function (Blueprint $table) {
                $table->dropColumn('key');
            });

            Schema::whenTableHasColumn($table->getTable(), 'value', function (Blueprint $table) {
                $table->dropColumn('value');
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'phone', function (Blueprint $table) {
                $table->string('phone')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'email', function (Blueprint $table) {
                $table->string('email')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'address', function (Blueprint $table) {
                $table->string('address')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'coords', function (Blueprint $table) {
                $table->string('coords')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'telegram', function (Blueprint $table) {
                $table->string('telegram')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'whatsapp', function (Blueprint $table) {
                $table->string('whatsapp')->nullable();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'vk', function (Blueprint $table) {
                $table->string('vk')->nullable();
            });
        });
    }
};
