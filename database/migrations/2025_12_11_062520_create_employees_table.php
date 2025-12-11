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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');
            $table->foreignId('media_id');
            $table->string('designation');
            $table->string('address');
            $table->string('epf_number')->unique();
            $table->integer('annual_leave_count')->default(14);
            $table->integer('casual_leave_count')->default(7);



            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('media_id')->references('id')->on('media')->restrictOnDelete();
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
