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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('role')->nullable();
            $table->text('branch')->nullable();
            $table->text('type')->nullable();
            $table->text('img_path')->nullable();
            $table->rememberToken();

            $table->string('name');
            $table->text('course')->nullable();
            $table->text('year')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('age')->nullable();
            $table->text('sex')->nullable();
            $table->text('religion')->nullable();
            $table->text('civil_status')->nullable();    
            $table->text('address');                    
            $table->text('contactNumber');
            $table->text('Tuptnum')->nullable();
            $table->text('contract')->nullable();
            $table->text('cor')->nullable();
            $table->text('validID')->nullable();
            $table->text('vaccineCard')->nullable();
            $table->integer('laptop')->default(0);
            $table->integer('electricfan')->default(0);
            
            $table->date('lastpaidDate')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_scheduled')->default(0);     
            $table->text('roomdetails')->nullable();
            $table->text('specialization')->nullable();

            $table->text('guardianName');
            $table->text('guardianAddress');
            $table->text('guardianContactNumber');
            $table->text('guardianRelationship');
            $table->text('applicationForm');
        
            $table->string('status')->default("Pending");
            $table->softDeletes();
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
