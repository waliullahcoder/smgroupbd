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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('client_id');
            $table->string('payment_no');
            $table->date('payment_date')->nullable();
            $table->string('payment_type');
            $table->string('collection_type');
            $table->decimal('amount', 16, 2);
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('sales_id')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('on_return')->default(0);
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('collections');
    }
};
