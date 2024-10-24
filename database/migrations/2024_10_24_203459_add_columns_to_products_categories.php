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
        Schema::table('products_categories', function (Blueprint $table) {
            $table->boolean('featured')->after('visibility')->default(0);
            $table->boolean('popular')->after('featured')->default(0);
            $table->boolean('new_arrival')->after('popular')->default(0);
            $table->boolean('best_seller')->after('new_arrival')->default(0);
            $table->boolean('top_rated')->after('best_seller')->default(0);
            $table->boolean('menu_placement')->after('top_rated')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_categories', function (Blueprint $table) {
            $table->dropColumn(['featured', 'popular', 'new_arrival', 'best_seller', 'top_rated', 'menu_placement']);
        });
    }
};
