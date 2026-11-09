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
        Schema::create('liftings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('store_id');
            $table->foreignId('vendor_id');
            $table->foreignId('coa_setup_id');
            $table->string('lifting_no');
            $table->string('payment_type')->default('credit');
            $table->string('voucher_no');
            $table->date('lifting_date');
            $table->decimal('total_cost', 16, 2);
            $table->decimal('discount', 16, 2)->default(0.00);
            $table->decimal('net_amount', 16, 2)->default(0.00);
            $table->decimal('total_paid', 16, 2)->default(0.00);
            $table->decimal('return_amount', 16, 2)->default(0.00);
            $table->decimal('return_paid', 16, 2)->default(0.00);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('liftings');
    }
};
