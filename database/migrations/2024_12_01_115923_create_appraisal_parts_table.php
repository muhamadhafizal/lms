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
        Schema::create('appraisal_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_setup_id')->constrained('appraisal_setups')->cascadeOnDelete();
            $table->integer('part_id')->nullable();
            $table->string('model')->nullable();
            $table->string('title')->nullable();
            $table->string('weightage')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appraisal_parts');
    }
};
