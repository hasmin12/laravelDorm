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
        Schema::create('dormitorypayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('roomdetails')->nullable();
            $table->integer('laptop')->nullable();
            $table->integer('electricfan')->nullable();
            $table->float('totalAmount')->nullable();
            $table->text('receipt')->nullable();
            $table->text('img_path')->nullable();
            $table->text('payment_month');
            $table->date('paidDate')->nullable();
            $table->string('status')->default("Pending");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitorypayments');
    }
};
