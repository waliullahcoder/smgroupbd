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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('store_id');
            $table->foreignId('client_id');
            $table->foreignId('coa_setup_id')->nullable();
            $table->string('invoice');
            $table->string('date');
            $table->string('sales_type');
            $table->decimal('total_amount', 16, 2);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('total_paid', 16, 2)->default(0.00);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sales');
    }
};
