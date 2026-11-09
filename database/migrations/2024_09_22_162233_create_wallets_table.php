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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->foreignId('invest_id')->nullable();
            $table->foreignId('investor_profit_id')->nullable();
            $table->foreignId('investor_payment_id')->nullable();
            $table->foreignId('sattlement_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('amount_in', 16, 0)->default(0.00);
            $table->decimal('amount_out', 16, 0)->default(0.00);
            $table->string('type');
            $table->tinyInteger('approved')->default(0);
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
        Schema::dropIfExists('wallets');
    }
};
