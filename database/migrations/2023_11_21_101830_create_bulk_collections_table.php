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
        Schema::create('bulk_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->date('date');
            $table->decimal('amount', 16, 2);
            $table->string('payment_type')->default('Cash');
            $table->string('remarks')->nullable();
            $table->foreignId('coa_setup_id')->nullable();
            $table->foreignId('staff_id')->nullable();
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
        Schema::dropIfExists('bulk_collections');
    }
};
