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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->text('room_number');
            $table->date('request_date');
            $table->text('type');
            $table->text('description');
            $table->text('branch');
            $table->text('technicianName')->nullable();
            $table->text('residentName');

            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('completionPercentage')->default(0);
            $table->unsignedBigInteger('completionDays')->nullable();
            $table->date('completed_date')->nullable();
            $table->float('cost')->nullable();
            $table->text('img_path')->nullable();
            $table->string('status')->default('PENDING');
            $table->timestamps();
          

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
