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
        Schema::create('plan_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans', 'id')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};