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
        Schema::create('showcase_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail');
            // $table->text('images')->nullable();
            $table->text('short_description');
            // $table->longText('description');
            $table->string('slug');
            $table->bigInteger('serial')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcase_items');
    }
};
