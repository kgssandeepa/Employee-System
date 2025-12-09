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
        Schema::create('leave_requests', function (Blueprint $table) {
           $table->id();
            $table->timestamps();
            $table->string('reason');
            $table->enum('leave_type',['annual','casual']);
            $table->date('date');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_request');
    }
};
