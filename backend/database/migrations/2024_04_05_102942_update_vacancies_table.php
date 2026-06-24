<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'name_third', function (Blueprint $table) {
                $table->string('name_third')->nullable()->change();
            });

            Schema::whenTableHasColumn($table->getTable(), 'salary', function (Blueprint $table) {
                $table->dropColumn('salary');
            });

            Schema::whenTableHasColumn($table->getTable(), 'terms', function (Blueprint $table) {
                $table->json('terms')->change();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'show_on_home', function (Blueprint $table) {
                $table->boolean('show_on_home')->default(false)->after('link');
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'deleted_at', function (Blueprint $table) {
                $table->softDeletes();
            });
        });
    }

    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            Schema::whenTableHasColumn($table->getTable(), 'name_third', function (Blueprint $table) {
                $table->string('name_third')->change();
            });

            Schema::whenTableDoesntHaveColumn($table->getTable(), 'salary', function (Blueprint $table) {
                $table->string('salary');
            });

            Schema::whenTableHasColumn($table->getTable(), 'terms', function (Blueprint $table) {
                $table->string('terms')->nullable()->change();
            });

            Schema::whenTableHasColumn($table->getTable(), 'show_on_home', function (Blueprint $table) {
                $table->dropColumn('show_on_home');
            });

            Schema::whenTableHasColumn($table->getTable(), 'show_on_home', function (Blueprint $table) {
                $table->dropColumn('show_on_home');
            });

            Schema::whenTableHasColumn($table->getTable(), 'deleted_at', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        });
    }
};
