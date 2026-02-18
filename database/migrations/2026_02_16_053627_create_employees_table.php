<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('employee_code')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('aadhar_no');            
            $table->date('joining_date')->nullable();
            $table->string('qr_token')->unique()->nullable();
            $table->boolean('status')->default(true);
            $table->string('image')->nullable();
            $table->string('id_proof')->nullable(); 
            
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
