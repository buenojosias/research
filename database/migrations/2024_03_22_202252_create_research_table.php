<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pid')->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->json('repositories');
            $table->json('types');
            $table->json('terms');
            $table->json('combinations')->nullable();
            $table->year('start_year');
            $table->year('end_year');
            $table->json('languages');
            $table->date('requested_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
