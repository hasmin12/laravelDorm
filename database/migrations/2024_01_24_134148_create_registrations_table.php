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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default("Resident");
            $table->text('type');

            $table->string('branch')->default("Dormitory");
            $table->text('img_path')->nullable();
            $table->rememberToken();
            $table->text('address');
            $table->text('sex');
            $table->date('birthdate');
            $table->text('contacts');
            $table->text('Tuptnum');
            $table->text('contract')->nullable();
            $table->text('cor');
            $table->text('validId');
            $table->text('vaccineCard');
            $table->integer('laptop')->default(0);
            $table->integer('electricfan')->default(0);
            $table->string('status')->default("Pending");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
