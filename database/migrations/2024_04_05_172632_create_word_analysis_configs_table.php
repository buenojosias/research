<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_analysis_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('min_lenght')->default(4);
            $table->json('combinations');
            $table->json('excluded_words');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_analysis_configs');
    }
};
