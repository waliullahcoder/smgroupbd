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
        Schema::create('static_site_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->string('banner_title');
            $table->string('testimonial_title');
            $table->string('details_video_url')->nullable();
            $table->string('products_title');
            $table->string('header_bg_image');
            $table->string('banner_image');
            $table->string('welcome_image');
            $table->string('testimonial_image');
            $table->string('x_separator_image');
            $table->string('y_separator_image');
            $table->string('shop_button_link')->nullable();
            $table->string('contact_button_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_site_items');
    }
};
