<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_reference', function (Blueprint $table) {
            $table->foreignId('production_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reference_id')->constrained()->cascadeOnDelete();
            $table->string('suffix', 1)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_reference');
    }
};
