<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Project::query()
            ->each(function (Project $project) {
                $imagePath = filled(Arr::get($project->getAttributes(), 'image'))
                    ? storage_path('app/public/' . Arr::get($project->getAttributes(), 'image'))
                    : null;

                if ($imagePath && \Illuminate\Support\Facades\File::exists($imagePath)) {
                    $project
                        ->addMedia($imagePath)
                        ->toMediaCollection('image');
                }

                $imageMobilePath = filled(Arr::get($project->getAttributes(), 'image_mobile'))
                    ? storage_path('app/public/' . Arr::get($project->getAttributes(), 'image_mobile'))
                    : null;

                if ($imageMobilePath && \Illuminate\Support\Facades\File::exists($imageMobilePath)) {
                    $project
                        ->addMedia($imageMobilePath)
                        ->toMediaCollection('image_mobile');
                }
            });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('image_mobile');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image');
            $table->string('image_mobile');
        });
    }
};
