<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('author_position', function (Blueprint $table) {
            $table->id();

            $table->foreignId('author_id')
                ->constrained('authors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('position_id')
                ->constrained('positions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('author_position');
    }
};
