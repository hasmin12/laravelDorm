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
            $table->text('bedtype');
            $table->text('pax');
            $table->float('price');
            $table->string('status')->default('Vacant');
            $table->boolean('is_paid')->default(0);
            $table->string('img_path')->default('/storage/hostel/hostelroom.png');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('rating')->nullable();
            $table->string('wifi')->default('0');
            $table->boolean('air_conditioning')->default(0);
            $table->boolean('kettle')->default(0);
            $table->boolean('tv_with_cable')->default(0);
            $table->boolean('hot_shower')->default(0);
            $table->boolean('refrigerator')->default(0);
            $table->boolean('kitchen')->default(0);
            $table->boolean('hair_dryer')->default(0);
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
