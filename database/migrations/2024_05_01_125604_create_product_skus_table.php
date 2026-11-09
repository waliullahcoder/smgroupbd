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
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('variant');
            $table->decimal('lifting_price', 16, 2)->default(0.00);
            $table->decimal('price', 16, 2)->default(0.00);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('discount_tk', 16, 2)->default(0.00);
            $table->string('sku');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skus');
    }
};
