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
        Schema::create('maintenance_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenanceId');
            $table->foreign('maintenanceId')->references('id')->on('maintenances')->onDelete('cascade');
            $table->text('residentName');
            $table->text('type');
            $table->text('branch');
            $table->text('technicianName')->nullable();
            $table->float('days')->nullable();
            $table->text('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_reports');
    }
};
