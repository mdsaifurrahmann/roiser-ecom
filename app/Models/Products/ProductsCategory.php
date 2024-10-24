<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
    /**
     * @use HasFactory<\Database\Factories\Products/ProductsCategoryFactory>
     */

    use HasFactory;


    protected $table = 'products_categories';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
        'parent_id',
        'visibility',
        'discount',
        'discount_type',
        'menu_placement',
        'featured',
        'popular',
        'new_arrival',
        'best_seller',
        'top_rated',
    ];

    protected $casts = [
        'status' => 'boolean',
        'visibility' => 'boolean',
        'discount' => 'float',
        'parent_id' => 'integer',
        'discount_type' => 'string',
        'featured' => 'boolean',
        'popular' => 'boolean',
        'new_arrival' => 'boolean',
        'best_seller' => 'boolean',
        'top_rated' => 'boolean',
        'menu_placement' => 'string',
    ];

    public function subCategories()
    {
        return $this->hasMany(ProductsCategory::class, 'parent_id');
    }

    public function parentCategories()
    {
        return $this->belongsTo(ProductsCategory::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id')->chaperone('products');
    }
}
