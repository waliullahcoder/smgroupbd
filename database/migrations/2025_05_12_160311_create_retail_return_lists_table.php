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
        Schema::create('retail_return_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('retail_return_id')->constrained()->onDelete('cascade');
            $table->foreignId('retail_sale_list_id');
            $table->foreignId('product_id');
            $table->foreignId('variant_id')->nullable();
            $table->foreignId('store_id');
            $table->decimal('price', 16, 2);
            $table->decimal('qty', 16, 2);
            $table->decimal('amount', 16, 2);
            $table->decimal('product_discount', 16, 2)->default(0.00);
            $table->decimal('sales_discount', 16, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_return_lists');
    }
};
