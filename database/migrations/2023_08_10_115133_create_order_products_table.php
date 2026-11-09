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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->json('choose_options')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('sale_price', 16, 2)->default(0.00);
            $table->decimal('subtotal', 16, 2)->default(0.00);
            $table->decimal('return_amount', 16, 2)->default(0.00);
            $table->decimal('quantity', 16, 2);
            $table->boolean('delivered')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
