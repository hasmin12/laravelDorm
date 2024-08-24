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
        Schema::create('residentlogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('name')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('leave_date')->nullable();
            $table->date('expectedReturn')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->text('purpose')->nullable();
            $table->text('gatepass')->nullable();
            $table->string('status')->default("Active");
            $table->date('dateLog')->nullable();
            
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residentlogs');
    }
};
