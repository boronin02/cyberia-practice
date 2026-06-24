<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->after('id')->nullable();
        });

        DB::table('projects')
            ->orderBy('id')
            ->each(function ($project) {
                $baseSlug = Str::slug($project->title);
                $slug = $baseSlug;
                $suffix = 1;

                while (
                    DB::table('projects')
                        ->where('slug', $slug)
                        ->where('id', '!=', $project->id)
                        ->exists()
                ) {
                    $slug = "{$baseSlug}-{$suffix}";
                    $suffix++;
                }

                DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['slug' => $slug]);
            });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->after('id')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
