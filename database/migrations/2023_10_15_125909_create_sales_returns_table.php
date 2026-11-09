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
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->foreignId('client_id');
            $table->foreignId('store_id');
            $table->string('return_no');
            $table->date('date');
            $table->decimal('amount', 16, 2);
            $table->string('remarks')->nullable();
            $table->tinyInteger('approve')->default(0);
            $table->foreignId('approve_by')->nullable();
            $table->tinyInteger('reject')->default(0);
            $table->foreignId('reject_by')->nullable();
            $table->tinyInteger('accounts_approve')->default(0);
            $table->foreignId('accounts_approve_by')->nullable();
            $table->foreignId('collection_id')->nullable();
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
        Schema::dropIfExists('sales_return_lists');
        Schema::dropIfExists('sales_returns');
    }
};
