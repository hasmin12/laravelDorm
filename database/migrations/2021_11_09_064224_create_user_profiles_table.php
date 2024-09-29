<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('year')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('religion')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('address')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('Tuptnum')->nullable();
            $table->string('contract')->nullable();
            $table->string('cor')->nullable();
            $table->string('validID')->nullable();
            $table->string('vaccineCard')->nullable();
            $table->string('applicationForm')->nullable();
            $table->boolean('laptop')->default(0);
            $table->boolean('electricfan')->default(0);
            $table->string('guardianName')->nullable();
            $table->string('guardianAddress')->nullable();
            $table->string('guardianContactNumber')->nullable();
            $table->string('guardianRelationship')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_scheduled')->default(0);

            $table->foreignId('user_id')->cascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
