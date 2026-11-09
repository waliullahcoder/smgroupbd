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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('coa_setup_id')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('nid')->nullable();
            $table->string('document')->nullable();
            $table->string('bkash')->nullable();
            $table->string('rocket')->nullable();
            $table->string('nagad')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('investors');
    }
};
