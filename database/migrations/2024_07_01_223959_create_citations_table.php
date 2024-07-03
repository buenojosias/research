<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reference_id')->constrained()->cascadeOnDelete();
            $table->mediumText('content');
            $table->enum('type', ['Direta', 'Indireta']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citations');
    }
};
