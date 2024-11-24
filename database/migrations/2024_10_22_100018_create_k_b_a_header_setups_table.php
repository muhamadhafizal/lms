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
        Schema::create('k_b_a_header_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kba_form_id')->constrained('k_b_a_forms')->cascadeOnDelete();
            $table->integer('header')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_b_a_header_setups');
    }
};
