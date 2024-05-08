<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bibliometric_id')->constrained()->cascadeOnDelete();
            $table->string('word', 36);
            $table->json('production_types');
            $table->json('records');
            $table->json('sections');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_counts');
    }
};
