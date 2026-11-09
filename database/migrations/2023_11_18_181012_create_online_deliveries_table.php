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
        Schema::create('online_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('vehicle_id');
            $table->foreignId('driver_id');
            $table->foreignId('delivery_man_id');
            $table->string('serial_no')->unique();
            $table->date('date')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('online_deliveries');
    }
};
