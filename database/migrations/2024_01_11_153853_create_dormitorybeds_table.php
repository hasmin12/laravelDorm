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
        Schema::create('dormitorybeds', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('type');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('dormitoryrooms')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('user_image')->nullable();

            $table->string('status')->default('vacant');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitorybeds');
    }
};
