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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('order_code')->unique();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('invoice')->nullable();
            $table->date('date')->nullable();
            $table->string('user_name');
            $table->string('user_phone');
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->text('shipping_address')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->decimal('shipping_charge', 16, 2)->nullable();
            $table->decimal('sub_total', 16, 2);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('total', 16, 2);
            $table->decimal('paid', 16, 2);
            $table->decimal('total_return', 16, 2)->default(0.00);
            $table->decimal('due', 16, 2)->default(0.00);
            $table->decimal('receive', 16, 2)->default(0.00);
            $table->string('payment_method')->default('cod');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreignId('delivery_man_id')->nullable();
            $table->boolean('collected')->default(0);
            $table->string('status')->default('Pending');
            $table->string('order_type')->default('offline');
            $table->boolean('pre_order')->default(0);
            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('successed_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('return_at')->nullable();
            $table->text('order_note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
