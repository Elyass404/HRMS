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
                $table->unsignedBigInteger('department')->nullable()->change();
                $table->unsignedBigInteger('contract_type')->nullable()->change();
                $table->unsignedBigInteger('position')->nullable()->change();
    
                $table->foreign('department')->references('id')->on('departments')->onDelete('set null');
                $table->foreign('contract_type')->references('id')->on('contract_types')->onDelete('set null');
                $table->foreign('position')->references('id')->on('positions')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropForeign(['department_id']);
            $table->dropForeign(['contract_type_id']);
        });
    }
};
