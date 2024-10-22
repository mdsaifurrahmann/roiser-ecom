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
            $table->unsignedBigInteger('id', true);
            $table->string('product_code');
            $table->string('name');

            $table->text('thumbnail')->nullable();
            $table->text('video_link')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('size_guide')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('category_id')->references('id')->on('products_categories')->onDelete('set NULL');
            $table->foreign('sub_category_id')->references('id')->on('products_categories')->onDelete('set NULL');
            $table->foreign('size_guide')->references('id')->on('product_size_guides')->onDelete('set NULL');
            $table->foreign('user_id')->references('id')->on('sys_controller')->onDelete('set NULL');


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
