<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('selected_project_id')->nullable()->after('active')->constrained('projects')->nullOnDelete();
            $table->string('selected_project_theme')->nullable()->after('selected_project_id')->nullOnDelete();
            $table->string('selected_project_role', 30)->nullable()->after('selected_project_theme')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['selected_project_id']);
            $table->dropColumn('selected_project_id');
            $table->dropColumn('selected_project_theme');
            $table->dropColumn('selected_project_role');
        });
    }
};
