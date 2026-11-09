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
        Schema::create('vendor_payment_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_payment_id')->constrained()->onDelete('cascade');
            $table->foreignId('lifting_id');
            $table->decimal('paid', 16, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_payment_data');
    }
};
