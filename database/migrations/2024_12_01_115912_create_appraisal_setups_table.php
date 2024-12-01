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
        Schema::create('appraisal_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained('batch_setups')->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->timestamps('review_start_date');
            $table->timestamps('review_end_date');
            $table->timestamps('rating_start_date');
            $table->timestamps('rating_end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appraisal_setups');
    }
};
