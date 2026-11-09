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
        Schema::create('retail_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('retail_sale_id');
            $table->foreignId('store_id');
            $table->string('return_no');
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->date('date');
            $table->decimal('amount', 16, 2);
            $table->string('remarks')->nullable();
            $table->boolean('approve')->default(false);
            $table->foreignId('approve_by')->nullable();
            $table->boolean('reject')->default(false);
            $table->foreignId('reject_by')->nullable();
            $table->boolean('accounts_approve')->default(false);
            $table->foreignId('accounts_approve_by')->nullable();
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
        Schema::dropIfExists('retail_returns');
    }
};
