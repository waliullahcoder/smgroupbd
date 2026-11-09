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
        Schema::create('online_delivery_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_delivery_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id');
            $table->foreignId('order_id');
            $table->decimal('amount', 16, 2);
            $table->decimal('discount', 16, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_delivery_lists');
    }
};
