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
        Schema::create('plan_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans', 'id')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->integer('receipt_after')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_outputs');
    }
};
