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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('maintenance_user_id')->nullable();  // Added maintenance_user_id
            $table->foreign('maintenance_user_id')->references('id')->on('users')->onDelete('set null'); // Foreign key for maintenance_user_id
            $table->string('type');
            $table->string('room_details');

            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled'])->default('pending');
            $table->unsignedTinyInteger('completion_percentage')->default(0);  // Added completion_percentage
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
