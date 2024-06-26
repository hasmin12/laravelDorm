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
            $table->float('downPayment');
            $table->float('totalPayment');
            $table->string('password');

            $table->string('name');
            $table->string('email');
            $table->text('roomName')->nullable();
            $table->string('role')->default('Resident');
            $table->text('img_path')->nullable();
            $table->rememberToken();
            $table->text('address');
            $table->text('sex');
            $table->date('birthdate');
            $table->text('contacts');
            $table->text('receipt')->nullable();
            $table->text('downreceipt');
            $table->string('review')->default("No");

            $table->string('status')->default('Pending');
            $table->text('qrcode')->nullable();
            $table->text('qrcodeImage')->nullable();

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
