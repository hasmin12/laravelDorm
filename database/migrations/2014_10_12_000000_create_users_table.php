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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('role')->nullable();
            $table->text('branch')->nullable();
            $table->text('img_path')->nullable();
            $table->rememberToken();
            $table->text('address');
            $table->text('sex');
            $table->date('birthdate');
            $table->text('contacts');

            $table->text('Tuptnum')->nullable();
            $table->text('contract')->nullable();
            $table->text('cor')->nullable();
            $table->text('validId')->nullable();
            $table->text('vaccineCard')->nullable();
            
            $table->text('type')->nullable();
            $table->date('lastpaidDate')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_scheduled')->default(0);
            $table->integer('laptop')->default(0);
            $table->integer('electricfan')->default(0);
            $table->text('roomdetails')->nullable();
            $table->text('status')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
