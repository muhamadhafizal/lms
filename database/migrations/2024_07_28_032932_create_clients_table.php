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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('next_renewal_date')->nullable();
            $table->boolean('is_active')->default(1);
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
            $table->string('contact_person')->nullable();
            $table->string('contact_tel')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('logo_file_name')->nullable();
            $table->boolean('is_subscribed')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
