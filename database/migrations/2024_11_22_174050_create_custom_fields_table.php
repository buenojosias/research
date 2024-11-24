<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bibliometric_id')->constrained()->onDelete('cascade');
            $table->string('name', 50);
            $table->string('type', 50);
            $table->json('options')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
};
