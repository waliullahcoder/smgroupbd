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
        Schema::create('investor_profit_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_profit_id')->constrained()->onDelete('cascade');
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->integer('share_qty');
            $table->decimal('amount', 16, 0);
            $table->decimal('deposited_amount', 16, 0)->default(0);
            $table->tinyInteger('deposited')->default(0);
            $table->date('deposit_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_profit_lists');
    }
};
