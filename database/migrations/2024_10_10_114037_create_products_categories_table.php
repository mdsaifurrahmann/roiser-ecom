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
        Schema::create('products_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name');
            $table->string('slug');
            $table->text('image')->nullable();
            $table->boolean('status')->default(1);
            $table->decimal('discount')->nullable();
            $table->string('discount_type')->default('percentage')->nullable();
            $table->boolean('visibility')->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('products_categories')->onDelete('set NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_categories');
    }
};
