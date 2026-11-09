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
        Schema::create('sales_return_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('sales_return_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id');
            $table->foreignId('sales_list_id');
            $table->foreignId('product_id');
            $table->foreignId('variant_id')->nullable();
            $table->foreignId('store_id');
            $table->decimal('price', 16, 2);
            $table->decimal('qty', 16, 2);
            $table->decimal('amount', 16, 2);
            $table->decimal('sales_discount', 16, 2)->default(0.00);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_return_lists');
    }
};
