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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('product_type')->default('Consumer');
            $table->string('transfer_no')->unique();
            $table->date('date')->nullable();
            $table->foreignId('host_id');
            $table->foreignId('destination_id');
            $table->string('remarks')->nullable();
            $table->tinyInteger('approve')->default(0);
            $table->foreignId('approve_by')->nullable();
            $table->tinyInteger('reject')->default(0);
            $table->foreignId('reject_by')->nullable();
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
        Schema::dropIfExists('transfers');
    }
};
