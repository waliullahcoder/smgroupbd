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
        Schema::create('invests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->string('invest_no');
            $table->date('date')->nullable();
            $table->integer('qty');
            $table->decimal('amount', 16, 0);
            $table->string('deposit_type');
            $table->string('bkash')->nullable();
            $table->string('rocket')->nullable();
            $table->string('nagad')->nullable();
            $table->string('bank_account')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->string('status')->default('Pending');
            $table->tinyInteger('sattled')->default(0);
            $table->foreignId('coa_setup_id')->nullable();
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
        Schema::dropIfExists('invests');
    }
};
