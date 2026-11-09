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
        Schema::create('lifting_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lifting_id')->constrained('liftings')->onDelete('cascade');
            $table->foreignId('company_id');
            $table->foreignId('store_id');
            $table->foreignId('vendor_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('variant_id')->nullable();
            $table->string('product_type')->default('Consumer');
            $table->decimal('lifting_price', 16, 2);
            $table->date('expiry_date')->nullable();
            $table->decimal('qty', 16, 2)->default(1);
            $table->decimal('total_amount', 16, 2);
            $table->decimal('discount', 16, 2);
            $table->decimal('net_amount', 16, 2)->default(0.00);
            $table->decimal('total_paid', 16, 2)->default(0.00);
            $table->decimal('return_qty')->default(0.00);
            $table->decimal('return_amount')->default(0.00);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifting_products');
    }
};
