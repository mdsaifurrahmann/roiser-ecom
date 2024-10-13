<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image'
    ];

    protected $table = 'product_colors';
}
