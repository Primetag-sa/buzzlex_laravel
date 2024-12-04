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
        Schema::create('photographer_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id')->constrained()->onDelete('cascade');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photographer_availability');
    }
};
