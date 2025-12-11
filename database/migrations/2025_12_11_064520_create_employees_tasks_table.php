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
        Schema::create('employees_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->foreignId('task_id');
           


            $table->foreign('employee_id')->references('id')->on('employees')->restrictOnDelete();
            $table->foreign('task_id')->references('id')->on('tasks')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_tasks');
    }
};
