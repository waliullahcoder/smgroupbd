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
        Schema::create('lifting_return_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('lifting_return_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id');
            $table->foreignId('store_id');
            $table->foreignId('lifting_id');
            $table->foreignId('lifting_product_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('product_id');
            $table->foreignId('variant_id')->nullable();
            $table->decimal('lifting_price', 16, 2);
            $table->decimal('qty', 16, 2);
            $table->decimal('amount', 16, 2);
            $table->decimal('lifting_discount', 16, 2);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifting_return_lists');
    }
};
