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
        Schema::create('lostitems', function (Blueprint $table) {
            $table->id();
            $table->text('itemName');
            $table->date('dateLost');
            $table->text('locationLost');
            $table->text('branch');
            $table->text('findersName');
            $table->text('claimedBy')->nullable();
            $table->date('claimedDate')->nullable();
            $table->string('status')->default('Unclaimed');
            $table->text('img_path');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lostitems');
    }
};
