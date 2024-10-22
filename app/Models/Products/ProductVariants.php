<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Products;
use App\Models\Products\ProductColor;
use App\Models\Products\ProductSize;

class ProductVariants extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'price',
        'sale_price',
        'stock',
        'sku',
        'media',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
}
