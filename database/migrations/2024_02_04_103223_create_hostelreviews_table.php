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
        Schema::create('hostelreviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('hostelrooms')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable(); // If the review is from registered users
            $table->string('name'); // Name of the reviewer (for anonymous reviews)
            $table->text('review');
            $table->unsignedTinyInteger('rating'); // Rating out of 5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostelreviews');
    }
};
