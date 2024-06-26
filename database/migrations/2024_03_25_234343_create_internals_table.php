<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained()->cascadeOnDelete();
            $table->string('section', 12);
            $table->longText('content');
            $table->unsignedInteger('total_words');
            $table->timestamps();
            $table->softDeletes();
            $table->fullText('content');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internals');
    }
};
