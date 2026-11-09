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
        Schema::create('bulk_collection_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulk_collection_id')->constrained()->onDelete('cascade');
            $table->foreignId('collection_id');
            $table->foreignId('client_id');
            $table->foreignId('sales_id');
            $table->decimal('invoice_amount', 16, 2);
            $table->decimal('paid_amount', 16, 2);
            $table->string('money_receipt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_collection_lists');
    }
};
