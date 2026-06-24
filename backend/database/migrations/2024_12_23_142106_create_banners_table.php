<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('banners', static function (Blueprint $table) {
            $table->id();

            $table->string('title')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->unsignedTinyInteger('order');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
