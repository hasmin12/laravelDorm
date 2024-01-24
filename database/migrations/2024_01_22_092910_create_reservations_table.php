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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('hostelrooms')->onDelete('cascade');
            $table->date('reservation_date');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->decimal('downPayment',8,2);
            $table->decimal('totalPayment',8,2);

            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('role')->default('Resident');
            $table->text('branch')->default('Hostel');
            $table->text('img_path')->nullable();
            $table->rememberToken();
            $table->text('address');
            $table->text('sex');
            $table->date('birthdate');
            $table->text('contacts');

            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
