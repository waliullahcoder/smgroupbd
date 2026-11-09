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
        Schema::create('investor_profits', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->integer('year');
            $table->string('month');
            $table->date('date')->nullable();
            $table->decimal('total_profit', 16, 0);
            $table->decimal('investor_percentage', 16, 0);
            $table->integer('total_share');
            $table->decimal('amount', 16, 0);
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
        Schema::dropIfExists('investor_profits');
    }
};
