<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_field_production', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_field_id')->constrained()->onDelete('cascade');
            $table->foreignId('production_id')->constrained()->onDelete('cascade');
            $table->string('value', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_field_production');
    }
};
