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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->boolean('laptop');
            $table->boolean('electricfan');
            $table->timestamp('payment_date')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('current_month'); // Current month
            $table->string('or_number')->nullable(); // Add or_number
            $table->string('or_image')->nullable();  // Add or_image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
