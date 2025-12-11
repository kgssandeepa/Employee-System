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
        Schema::create('leave_request', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reason');
            $table->enum('leave_type', ['annual', 'casual']);
            $table->date('date');
            $table->foreignId('employee_id');

            $table->foreign('employee_id')->references('id')->on('employees')->restrictOnDelete();
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
