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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('employee_id'); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->string('type'); 
            $table->enum('status', ['pending', 'approved by manager', 'approved', 'rejected'])->default('pending'); 
            $table->unsignedBigInteger('approver_id')->nullable(); 
            $table->timestamps(); 
    
            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
