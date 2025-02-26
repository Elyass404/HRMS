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
        Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('department')->nullable();
                $table->unsignedBigInteger('role')->nullable();
                $table->unsignedBigInteger('contract_type')->nullable();
    
                $table->foreign('department')->references('id')->on('departments')->onDelete('set null');
                $table->foreign('role')->references('id')->on('roles')->onDelete('set null');
                $table->foreign('contract_type')->references('id')->on('contract_types')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropForeign(['department_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['contract_type_id']);
        });
    }
};
