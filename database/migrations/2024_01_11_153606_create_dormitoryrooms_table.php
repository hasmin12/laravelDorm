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
        Schema::create('dormitoryrooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('occupiedBeds')->default(4);
            $table->integer('totalBeds')->default(0);
            $table->text('type');
            $table->text('category');
            $table->string('status')->default('Active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitoryrooms');
    }
};
