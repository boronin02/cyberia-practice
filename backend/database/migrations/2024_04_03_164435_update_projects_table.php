<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'description', function (Blueprint $table) {
                $table->text('description')->change();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'show_on_home', function (Blueprint $table) {
                $table->boolean('show_on_home')->default(false)->after('is_big');
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'order', function (Blueprint $table) {
                $table->unsignedInteger('order')->after('is_big')->unique();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'home_order', function (Blueprint $table) {
                $table->unsignedInteger('home_order')->after('is_big')->nullable()->unique();
            });

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'description', function (Blueprint $table) {
                $table->string('description')->change();
            });

            Schema::whenTableHasColumn($table->getTable(), 'show_on_home', function (Blueprint $table) {
                $table->dropColumn('show_on_home');
            });

            Schema::whenTableHasColumn($table->getTable(), 'order', function (Blueprint $table) {
                $table->dropColumn('order');
            });

            Schema::whenTableHasColumn($table->getTable(), 'home_order', function (Blueprint $table) {
                $table->dropColumn('home_order');
            });

            $table->dropSoftDeletes();
        });
    }
};
