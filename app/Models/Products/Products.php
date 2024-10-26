<?php

namespace App\Models\Products;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'slug',
        'description',
        'category_id',
        'sub_category_id',
        'video_link',
        'size_guide',
        'thumbnail',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductsCategory::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductsCategory::class, 'sub_category_id');
    }

    public function sizeGuide()
    {
        return $this->belongsTo(ProductSizeGuide::class, 'size_guide');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariants::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
