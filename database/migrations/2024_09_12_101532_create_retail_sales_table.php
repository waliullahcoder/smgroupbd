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
        Schema::create('retail_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->string('payment_type')->nullable();
            $table->foreignId('coa_setup_id')->nullable();
            $table->foreignId('retail_return_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('store_id');
            $table->string('invoice');
            $table->string('date');
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->decimal('total_amount', 16, 2);
            $table->decimal('product_discount', 16, 2)->default(0.00);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('net_amount', 16, 2)->default(0.00);
            $table->decimal('return_deduction', 16, 2)->default(0.00);
            $table->decimal('receive_amount', 16, 2)->default(0.00);
            $table->decimal('change_amount', 16, 2)->default(0.00);
            $table->boolean('status')->default(1);
            $table->foreignId('staff_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_sales');
    }
};
