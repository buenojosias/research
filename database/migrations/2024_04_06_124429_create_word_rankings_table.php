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
        Schema::create('word_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id')->constrained()->cascadeOnDelete();
            $table->foreignId('publication_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('words_limit');
            $table->json('filters');
            $table->json('records');
            $table->boolean('publications_flag')->default(false);
            $table->boolean('config_flag')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_rankings');
    }
};
