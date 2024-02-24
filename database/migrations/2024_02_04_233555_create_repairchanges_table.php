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
        Schema::create('repairchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_id');
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
            $table->text('description');
            $table->unsignedBigInteger('changePercentage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairchanges');
    }
};
