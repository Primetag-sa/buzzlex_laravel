<?php

use App\Models\Proposal;
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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_order_id')->constrained('general_orders', 'id')->onDelete('cascade');
            $table->foreignId('photographer_id')->constrained('photographers', 'id')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plans', 'id')->onDelete('cascade');
            $table->string('status')->default(Proposal::PENDING);
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
