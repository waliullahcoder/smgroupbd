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
        Schema::create('group_sales_target_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_sales_target_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->decimal('target', 16, 2);
            $table->decimal('target_amount', 16, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_sales_target_categories');
    }
};
