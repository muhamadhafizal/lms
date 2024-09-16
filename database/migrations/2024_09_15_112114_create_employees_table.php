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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('security_group_id')->constrained('security_groups')->cascadeOnDelete();
            $table->foreignId('race_id')->nullable()->constrained('races')->cascadeOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained('religions')->cascadeOnDelete();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('work_location_id')->nullable()->constrained('work_locations')->cascadeOnDelete();
            $table->foreignId('cost_centre_id')->nullable()->constrained('cost_centres')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained('sections')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->foreignId('job_grade_id')->nullable()->constrained('job_grades')->cascadeOnDelete();
            $table->foreignId('business_unit_id')->nullable()->constrained('business_units')->cascadeOnDelete();
            $table->foreignId('qualification_id')->nullable()->constrained('qualifications')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
