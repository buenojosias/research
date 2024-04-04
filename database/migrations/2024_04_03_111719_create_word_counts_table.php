<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('word_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id')->constrained()->cascadeOnDelete();
            $table->string('word', 36);
            $table->json('publication_types');
            $table->json('records');
            $table->json('sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_counts');
    }
};
