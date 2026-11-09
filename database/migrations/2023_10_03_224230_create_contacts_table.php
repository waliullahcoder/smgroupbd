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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('title')->nullable();
            $table->text('address');
            $table->text('work_time');
            $table->string('primary_mobile');
            $table->string('primary_email');
            $table->string('secondary_mobile');
            $table->string('secondary_email');
            $table->text('map_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
