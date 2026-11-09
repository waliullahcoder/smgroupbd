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
        Schema::create('investor_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->string('payment_no');
            $table->date('date')->nullable();
            $table->decimal('amount', 16, 0);
            $table->string('deposit_type');
            $table->string('bkash')->nullable();
            $table->string('rocket')->nullable();
            $table->string('nagad')->nullable();
            $table->string('bank_account')->nullable();
            $table->text('remarks')->nullable();
            $table->text('data');
            $table->tinyInteger('approved')->default(0);
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('investor_payments');
    }
};
