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
        Schema::create('employee_feedback_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('efs_id')->constrained('employee_feedback_setups')->cascadeOnDelete();
            $table->string('question');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_feedback_questions');
    }
};
