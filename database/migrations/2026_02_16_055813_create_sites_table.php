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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('location');
            $table->date('date');
            $table->string('number_of_employees');
            $table->enum('shift', ['morning', 'lunch', 'evening', 'night']);
            $table->time('reporting_time')->nullable();
            $table->string('status')->default('active');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('bill_amount');
            $table->string('bill_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
