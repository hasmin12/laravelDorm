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
        Schema::create('hostelrooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->unsignedBigInteger('floorNum')->nullable();
            $table->text('type');
            $table->text('pax');
            $table->float('price');
            $table->string('status')->default('Vacant');
            $table->string('img_path')->default('/storage/hostel/hostelroom.png');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('rating')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostelrooms');
    }
};
