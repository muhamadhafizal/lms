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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('former_name')->nullable();
            $table->string('roc_one')->nullable();
            $table->string('roc_two')->nullable();
            $table->string('contact')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('address_three')->nullable();
            $table->string('postal')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_nric')->nullable();
            $table->string('person_designation')->nullable();
            $table->string('person_email')->nullable();
            $table->string('person_contact')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('next_renewal_date')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
