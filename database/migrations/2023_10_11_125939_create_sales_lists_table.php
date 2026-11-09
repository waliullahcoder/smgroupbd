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
        Schema::create('sales_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('sales_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id');
            $table->foreignId('client_id');
            $table->foreignId('product_id');
            $table->foreignId('variant_id')->nullable();
            $table->foreignId('order_product_id')->nullable();
            $table->decimal('rate', 16, 2);
            $table->decimal('qty', 16, 2);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('amount', 16, 2);
            $table->decimal('returned_qty', 16, 2)->default(0.00);
            $table->decimal('returned_amount', 16, 2)->default(0.00);
            $table->tinyInteger('is_return')->default(0);
            $table->string('delivery_status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_lists');
    }
};
