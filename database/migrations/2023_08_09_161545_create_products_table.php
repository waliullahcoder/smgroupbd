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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('product_type')->default('Consumer');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->text('more_images')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->bigInteger('alert_quantity')->nullable();
            $table->bigInteger('min_order')->default(1);
            $table->bigInteger('max_order')->nullable();
            $table->string('video')->nullable();
            $table->string('video_id')->nullable();
            $table->float('ctn_size')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('check_stock')->default(0);
            $table->tinyInteger('show_on_website')->default(1);
            $table->tinyInteger('trending')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('top_rated')->default(0);
            $table->tinyInteger('best_selling')->default(0);
            $table->integer('allowed_investor')->default(1);
            $table->decimal('shared_profit', 16, 2)->nullable();
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
        Schema::dropIfExists('products');
    }
};
