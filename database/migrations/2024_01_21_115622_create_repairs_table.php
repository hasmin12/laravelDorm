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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->text('room_number');
            $table->date('request_date');
            $table->text('itemName');
            $table->text('description');
            $table->text('branch');
            $table->text('technicianName')->nullable();
            $table->text('residentName');

            // $table->unsignedBigInteger('technician_id')->nullable();
            // $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->date('completion_date')->nullable();
            $table->decimal('cost',6,2)->nullable();
            $table->text('img_path')->nullable();
            $table->string('status')->default("Pending");

            $table->timestamps();
          

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
