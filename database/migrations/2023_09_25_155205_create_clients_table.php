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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->foreignId('coa_setup_id')->nullable();
            $table->foreignId('reference_by')->nullable();
            $table->foreignId('client_category_id');
            $table->foreignId('area_id');
            $table->foreignId('territory_id');
            $table->bigInteger('code');
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->decimal('credit_limit', 16, 2)->nullable();
            $table->bigInteger('bin_no')->nullable();
            $table->foreignId('chain_client_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_chain')->default(0);
            $table->tinyInteger('is_vat')->default(0);
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
        Schema::dropIfExists('clients');
    }
};
