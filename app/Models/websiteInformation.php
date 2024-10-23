<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class websiteInformation extends Model
{
    use HasFactory;

    protected $table = 'website_information';

    protected $fillable = [
        'target',
        'data',
    ];
}
