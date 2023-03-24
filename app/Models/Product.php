<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'stock',
        'category_id',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'pivot',
    ];
}
